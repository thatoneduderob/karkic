<?php
  $app->get('/profile/:id', function($id) use ($app) {
    $user = $app->user->where('id', $id)->first();

    if(!$user) {
      $app->notFound();
    }

    $app->render('/user/profile.php', [
      'user' => $user
    ]);
  })->name('profile');