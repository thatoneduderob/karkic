<?php
  $app->get('/account/login', $guest(),  function() use ($app) {
    $app->render('/account/login.php');
  })->name('account.login');

  $app->post('/account/login', $guest(), function() use ($app) {
    $request = $app->request;

    $username = $request->post('username');
    $password = $request->post('password');
    $remember = $request->post('remember');

    $v = $app->validation;
    $v->validate([
      'username' => [$username, 'required'],
      'password' => [$password, 'required']
    ]);

    if($v->passes()) {
      $user = $app->user
        ->where('active', true)
        ->where('username', $username)
        ->first();

      if($user && $app->hash->passwordCheck($password, $user->password)) {
        $_SESSION[$app->config->get('auth.session')] = $user->id;

        $user->update([
          'lastLogin' => date("Y-m-d H:i:s")
        ]);

        if($remember === 'on') {
          $rememberIdentifier = $app->randomlib->generateString(128);
          $rememberToken = $app->randomlib->generateString(128);

          $user->updateRememberCredentials(
            $rememberIdentifier,
            $app->hash->hash($rememberToken)
          );

          $app->setCookie(
            $app->config->get('auth.remember'),
            "{$rememberIdentifier}___{$rememberToken}",
            Carbon\Carbon::parse('+1 week')->timestamp
          );
        }

        $app->flash('global', 'You have been signed in');
        $app->response->redirect($app->urlFor('home'));
      } else {
        $app->flash('global', 'We could not sign you in');
        $app->response->redirect($app->urlFor('user.login'));
      }
    }

    $app->render('account/login.php', [
      'errors' => $v->errors(),
      'request' => $request
    ]);
  })->name('account.login.post');