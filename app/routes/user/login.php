<?php
  $app->get('/user/login', $guest(),  function() use ($app) {
    $app->render('/user/login.php');
  })->name('user.login');

  $app->post('/user/login', $guest(), function() use ($app) {
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

        $app->flash('global', 'You are now signed in.');
        $app->response->redirect($app->urlFor('home'));
      } else {
        $app->flash('global', 'Could not log you in.');
        $app->response->redirect($app->urlFor('user.login'));
      }
    }

    $app->render('user/login.php', [
      'errors' => $v->errors(),
      'request' => $request
    ]);
  })->name('user.login.post');