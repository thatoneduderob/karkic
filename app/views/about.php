{% extends 'templates/default.php' %}

{% set title = 'Home' %}

{% block content %}
<h4>About us</h4>

<table class="bordered">
  <thead>
    <tr>
      <th>Information</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Date founded</td>
      <td>September 5, 2015</td>
    </tr>
    <tr>
      <td>Short description</td>
      <td>karkic was built to help teenagers in highschool meet. No one over the age of 18 or under the age of 15 is allowed to create an account. Members can post statuses to share with others, personal message their friends and more.</td>
    </tr>
  </tbody>
</table>
{% endblock %}
