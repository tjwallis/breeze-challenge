<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
  // Using People instead of person for the table name.
  protected $table = 'people';

  public function group() {
    return $this->belongsTo( 'App\Group' );
  }
}
