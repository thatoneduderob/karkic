<div class="sb_wd">
  <div class="col s3">
    <div class="card">
      <div class="card-content white-text">
        <span class="card-title">Account</span>
        {% if auth %}
          <p>Welcome, {{auth.username}}</p>
          <p><a class="waves-effect waves-light btn" href="{{urlFor('profile', {id: auth.id})}}">profile</a></p>
          <p><a class="waves-effect waves-light btn" href="{{urlFor('account.logout')}}">logout</a></p>
        {% else %}
        <p><a class="waves-effect waves-light btn" href="{{urlFor('account.register')}}">register</a></p>
        <p><a class="waves-effect waves-light btn" href="{{urlFor('account.login')}}">login</a></p>
        {% endif %}
      </div>
    </div>
  </div>
</div>
