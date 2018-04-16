<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  // Groups have many persons
  public function people() {
    return $this->hasMany('App\Person', 'person_id');
  }
}
