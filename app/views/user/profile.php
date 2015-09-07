{% extends 'templates/default.php' %}

{% set title %}
<strong>{{user.getFullNameOrUsername}}</strong>'s Profile
{% endset %}

{% block content %}
  <div class="row">
    <div class="col s3">
      <img src="{{ user.getAvatarUrl({size: 120}) }}" alt="Profile picture for {{ user.getFullNameOrUsername }}">
      <p id="karma">
        {{user.karmaPosition}} {{user.karmaLevel}}
        <br>karma
      </p>
    </div>
    <div class="col s9">
      <table id="profile">
        <tr>
          <td>description</td>
          <td>email</td>
          <td>{{user.email}}</td>
        </tr>
        <tr>
          <td></td>
          <td>real name</td>
          <td>{{user.getFullNameOrUsername}}</td>
        </tr>
        <tr>
          <td></td>
          <td>age</td>
          <td>{{user.age}}</td>
        </tr>
        <tr>
          <td></td>
          <td>last login</td>
          <td>{{user.getLastLogin(user.lastLogin)}}</td>
        </tr>
        <tr>
          <td>social</td>
          <td>snapchat</td>
          <td>{{user.snapchat}}</td>
        </tr>
        <tr>
          <td></td>
          <td>kik</td>
          <td>{{user.kik}}</td>
        </tr>
      </table>
    </div>
  </div>
{% endblock %}