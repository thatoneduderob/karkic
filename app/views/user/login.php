{% extends 'templates/default.php' %}

{% set title = 'Login' %}

{% block content %}
<h4>Login</h4>
<form action="{{ urlFor('user.login.post') }}" method="post" autocomplete="off">
  <div class="row">
    <div class="input-field col s12">
      <input id="username" name="username" type="text">
      <label for="username">Username</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <input id="password" name="password" type="password">
      <label for="password">Password</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <input type="checkbox" name="remember" id="remember"><label for="remember">Remember me?</label>
      <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <button class="btn waves-effect waves-light" type="submit" name="action">Login</button>
    </div>
  </div>
</form>
{% endblock %}
