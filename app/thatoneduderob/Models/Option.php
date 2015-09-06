<?php
  namespace thatoneduderob\Models;

  use Illuminate\Database\Eloquent\Model as Eloquent;

  class Option extends Eloquent {
    protected $table = 'options';
    protected $fillable = [];

    public function getSchools() {
      $schools = $this->where('id', 1)->first()->schools;
      return explode("|", $schools);
    }

    public function schoolsDropdown($app) {
      $result = null;
      $schs = $this->getSchools();

      $result = '<select class="form-control" name="school" id="school">';
      if($app->auth) {
        $result .= '<option value="'. $app->auth->school .'" selected>(Selected) '. $app->auth->school .'</option>';
      } else {
        $result .= '<option selected disabled>Select your location</option>';
      }
      foreach($schs as $sch) {
        $result .= '<option value="'. $sch .'">'. $sch .'</option>';
      }
      $result .= '</select>';
      return $result;
    }
  }