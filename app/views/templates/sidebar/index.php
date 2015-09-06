<div class="sb_wd">
  <div class="col s3">
    <div class="card">
      <div class="card-content white-text">
        <span class="card-title">Account</span>
        {% if auth %}
          <p>Welcome {{auth.username}}</p>
        {% else %}
        <p><a class="waves-effect waves-light btn" href="#">register</a></p>
        <p><a class="waves-effect waves-light btn" href="#">login</a></p>
        {% endif %}
      </div>
    </div>
  </div>
</div>
