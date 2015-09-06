{% extends 'templates/default.php' %}

{% set title = 'Register' %}

{% block content %}
  <form action="{{ urlFor('account.register.post') }}" method="post" autocomplete="off">
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
        <input id="first_name" name="first_name" type="text" {% if request.post('first_name') %}value="{{ request.post('first_name') }}"{% endif %}>
        <label for="first_name">First Name</label>
        {% if errors.has('first_name') %}{{ errors.first('first_name') }}{% endif %}
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="last_name" name="last_name" type="text" {% if request.post('last_name') %}value="{{ request.post('last_name') }}"{% endif %}>
        <label for="last_name">Last Name</label>
        {% if errors.has('last_name') %}{{ errors.first('last_name') }}{% endif %}
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
          <select class="browser-default" id="age" name="age">
            <option value="" disabled selected>{% if request.post('age') %}{{ request.post('age') }}{% else %}Select your age{% endif %}</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
          </select>
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