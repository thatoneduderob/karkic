{% extends 'templates/default.php' %}

{% set title = 'Login' %}

{% block content %}
<h4>Edit profile</h4>
<form action="{{ urlFor('account.edit.post') }}" method="post" autocomplete="off">
  <div class="row">
    <div class="input-field col s12">
      <input id="email" name="email" type="email" value="{{auth.email}}">
      <label for="email">Email</label>
      {% if errors.has('email') %}{{ errors.first('email') }}{% endif %}
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <input id="first_name" name="first_name" type="text" value="{{auth.first_name}}">
      <label for="first_name">First Name</label>
      {% if errors.has('first_name') %}{{ errors.first('first_name') }}{% endif %}
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <input id="last_name" name="last_name" type="text" value="{{auth.last_name}}">
      <label for="last_name">Last Name</label>
      {% if errors.has('last_name') %}{{ errors.first('last_name') }}{% endif %}
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <input id="snapchat" name="snapchat" type="text" value="{{auth.snapchat}}">
      <label for="snapchat">Snapchat</label>
      {% if errors.has('snapchat') %}{{ errors.first('snapchat') }}{% endif %}
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <input id="kik" name="kik" type="text" value="{{auth.kik}}">
      <label for="kik">Kik</label>
      {% if errors.has('kik') %}{{ errors.first('kik') }}{% endif %}
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <span>Age</span>
      <select class="browser-default" id="age" name="age">
        <option value="{{auth.age}}" selected>{{auth.age}}</option>
        <option disabled>----</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
      </select>
      {% if errors.has('age') %}{{ errors.first('age') }}{% endif %}
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <button class="btn waves-effect waves-light" type="submit" name="action">Submit</button>
    </div>
  </div>
</form>
{% endblock %}
