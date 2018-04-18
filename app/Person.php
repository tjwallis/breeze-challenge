<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
  // Using People instead of person for the table name.
  public $timestamps = false;
  protected $table = 'people';
  protected $fillable = [
  'group_id',
  'first_name',
  'last_name',
  'email',
  'status',
  'person_id',
  ];

  public function group() {
    return $this->belongsTo( 'App\Group', 'group_id' );
  }

  // Retrive Status as readable attribute.
  public function getStatusAttribute($value) {
    if($value == 1) {
      return 'active';
    }

    return 'archived';
  }

  public function setGroupIdAttribute($value) {
    $this->attributes['group_id'] = intval(trim($value));
  }

  public function setPersonIdAttribute($value) {
    $this->attributes['person_id'] = intval(trim($value));
  }

  // Store Status as an boolean.
  public function setStatusAttribute($value) {
    $value = trim($value);
    if($value == "active") {
      $this->attributes['status'] = true;
    } else {
      $this->attributes['status'] = false;
    }
  }

}
