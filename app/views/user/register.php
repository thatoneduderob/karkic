{% extends 'templates/default.php' %}

{% set title = 'Register' %}

{% block content %}
  <form action="{{ urlFor('user.register.post') }}" method="post" autocomplete="off">
    <div class="row">
      <div class="input-field col s12">
        <input id="email" name="email" type="email" {% if request.post('email') %}value="{{ request.post('email') }}"{% endif %}>
        <label for="email">Email</label>
        {% if errors.has('email') %}{{ errors.first('email') }}{% endif %}
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="username" name="username" type="text" {% if request.post('username') %}value="{{ request.post('username') }}"{% endif %}>
        <label for="username">Username</label>
        {% if errors.has('username') %}{{ errors.first('username') }}{% endif %}
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="password" name="password" type="password" {% if request.post('password') %}value="{{ request.post('password') }}"{% endif %}>
        <label for="password">Password</label>
        {% if errors.has('password') %}{{ errors.first('password') }}{% endif %}
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="password_confirm" name="password_confirm" type="password" {% if request.post('password_confirm') %}value="{{ request.post('password_confirm') }}"{% endif %}>
        <label for="password_confirm">Repeat Password</label>
        {% if errors.has('password_confirm') %}{{ errors.first('password_confirm') }}{% endif %}
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <button class="btn waves-effect waves-light" type="submit" name="action">Register</button>
      </div>
    </div>
    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
  </form>
{% endblock %}