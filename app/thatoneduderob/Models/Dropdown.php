<?php
  namespace thatoneduderob\Models;

  use Illuminate\Database\Eloquent\Model as Eloquent;

  class Dropdown extends Eloquent {
    protected $table = 'dropdowns';
    protected $fillable = [];

    public function getLocations() {
      $locs = $this->where('id', 1)->first()->locations;
      return explode("|", $locs);
    }

    public function locationDropdown($app) {
      $result = null;
      $locations = $this->where('id', 1)->first()->locations;
      $locs = explode("|", $locations);

      $result = '<select class="form-control" name="location" id="location">';
      if($app->auth) {
        $result .= '<option value="'. $app->auth->location .'" selected>(Selected) '. $app->auth->location .'</option>';
      } else {
        $result .= '<option selected disabled>Select your location</option>';
      }
      foreach($locs as $loc) {
        $result .= '<option value="'. $loc .'">'. $loc .'</option>';
      }
      $result .= '</select>';
      return $result;
    }
  }