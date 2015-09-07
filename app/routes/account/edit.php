<?php
  $app->get('/account/edit', $authenticated(),  function() use ($app) {
    $app->render('/account/edit.php');
  })->name('account.edit');

  $app->post('/account/edit', $authenticated(), function() use ($app) {
    $request = $app->request;

    $email = $request->post('email');
    $first_name = $request->post('first_name');
    $last_name = $request->post('last_name');
    $snapchat = $request->post('snapchat');
    $kik = $request->post('kik');
    $age = $request->post('age');

    $v = $app->validation;
    $v->validate([
      'email' => [$email, 'required|uniqueEmail'],
      'first_name' => [$first_name, 'required|alnumDash'],
      'last_name' => [$last_name, 'required|alnumDash'],
      'snapchat' => [$snapchat, 'alnumDash'],
      'kik' => [$kik, 'alnumDash'],
      'age' => [$age, 'required|alnumDash']
    ]);

    if($v->passes()) {
      $app->user->where('id', $app->auth->id)->update([
        'email' => $email,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'snapchat' => $snapchat,
        'kik' => $kik,
        'age' => $age
      ]);
      $app->flash('global', 'Your profile has been edited');
      $app->response->redirect($app->urlFor('home'));
    }

    $app->render('account/edit.php', [
      'errors' => $v->errors(),
      'request' => $request
    ]);
  })->name('account.edit.post');