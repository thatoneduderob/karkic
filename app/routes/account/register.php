<?php
  use thatoneduderob\User\UserPermission;

  $app->get('/account/register', $guest(), function() use ($app) {
    $app->render('account/register.php');
  })->name('account.register');

  $app->post('/account/register', $guest(), function() use ($app) {
    $request = $app->request;

    $email = $request->post('email');
    $username = $request->post('username');
    $password = $request->post('password');
    $password_confirm = $request->post('password_confirm');
    $age = $request->post('age');
    $first_name = $request->post('first_name');
    $last_name = $request->post('last_name');

    $v = $app->validation;
    $v->validate([
      'email' => [$email, 'required|email|uniqueEmail'],
      'username' => [$username, 'required|alnumDash|max(30)|uniqueUsername'],
      'password' => [$password, 'required|min(6)'],
      'password_confirm' => [$password_confirm, 'required|matches(password)'],
      'age' => [$age, 'required|alnumDash'],
      'first_name' => [$first_name, 'required|alnumDash'],
      'last_name' => [$last_name, 'required|alnumDash']
    ]);

    if($v->passes()) {
      $identifier = $app->randomlib->generateString(128);

      $user = $app->user->create([
        'email' => $email,
        'username' => $username,
        'password' => $app->hash->password($password),
        'active' => false,
        'active_hash' => $app->hash->hash($identifier),
        'age' => $age,
        'first_name' => $first_name,
        'last_name' => $last_name
      ]);

      $user->permissions()->create(UserPermission::$defaults);

      $app->mail->send(
        'email/account/register.php',
        ['user' => $user, 'identifier' => $identifier],
        function($message) use ($user) {
          $message->to($user->email);
          $message->subject("Thanks for registering!");
        }
      );

      $app->flash('global', 'You have been registered. Please check your email for an activation link.');
      $app->response->redirect($app->urlFor('home'));
    }

    $app->render('account/register.php', [
      'errors' => $v->errors(),
      'request' => $request
    ]);
  })->name('account.register.post');