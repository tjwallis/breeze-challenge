<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  // Groups have many persons
  public $timestamps = false;
  protected $fillable = [
    'group_id',
    'group_name',
  ];

  public function people() {
    return $this->hasMany('App\Person', 'group_id', 'group_id');
  }
}
