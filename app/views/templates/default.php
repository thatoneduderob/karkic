<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>karkic</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/css/materialize.css">
    <!-- <link rel="stylesheet" href="/HCSD/css/materialize.css"> -->
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="/css/custom.css">
  </head>
  <body>
    {% include 'templates/navigation/index.php' %}
    {% include 'templates/messages/index.php' %}
    <div class="row">
      {% include 'templates/sidebar/index.php' %}
      <div class="col s9">
        <div class="card">
          <div class="card-content white-text">
            {% block content %}{% endblock %}
          </div>
        </div>
      </div>
    </div>
    {% include 'templates/footer/index.php' %}
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/js/materialize.min.js"></script>
  </body>
</html>
