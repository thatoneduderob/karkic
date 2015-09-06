{% extends 'templates/default.php' %}

{% set title = 'Home' %}

{% block content %}
  {% if auth %}
    {% include 'versions/auth/home.php' %}
  {% else %}
    {% include 'versions/no_auth/home.php' %}
  {% endif %}
{% endblock %}
