<?php
  namespace thatoneduderob\User;

  use Illuminate\Database\Eloquent\Model as Eloquent;

  class User extends Eloquent {
    protected $table = 'users';
    protected $fillable = [
      'username',
      'password',
      'lastLogin',
      'active',
      'active_hash',
      'first_name',
      'last_name',
      'recover_hash',
      'remember_identifier',
      'remember_token',
      'email'
    ];

    public function getFullName() {
      if(!$this->first_name || !$this->last_name){
        return null;
      }

      return "{$this->first_name} {$this->last_name}";
    }

    public function getFullNameOrUsername() {
      return $this->getFullName() ?: $this->username;
    }

    public function activateAccount() {
      $this->update([
        'active' => true,
        'active_hash' => null
      ]);
    }

    public function getAvatarUrl($options = []) {
      if(file_exists("/profs/".$this->prof_hash."/profile.jpg")) {
        return "/profs/".$this->prof_hash."/profile.jpg";
      } else {
        $size = isset($options['size']) ? $options['size']: 45;
        return 'http://www.gravatar.com/avatar/'
                .md5($this->email)
                .'?s='
                .$size
                .'&d=mm';
      }
    }

    public function updateRememberCredentials($identifier, $token) {
      $this->update([
        'remember_identifier' => $identifier,
        'remember_token' => $token
      ]);
    }

    public function removeRememberCredentials() {
      $this->updateRememberCredentials(null, null);
    }

    public function hasPermission($perm) {
      return (bool) $this->permissions->{$perm};
    }

    public function isAdmin() {
      return $this->hasPermission('is_admin');
    }

    public function permissions() {
      return $this->hasOne('thatoneduderob\User\UserPermission', 'user_id');
    }

    public function getUsername($userId) {
      return $this->where('id', $userId)->first()->username;
    }
  }