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

  public function import($records) {
    $imported = array();
    foreach($records as $row) {
      try {
        Person::updateOrCreate(['person_id' => $row->person_id, $row->toArray());
      } catch( exception $e) {
        render($e);
        $imported[$row->person_id] = false;

        return false;
      }
    }

    return $imported;
  }
}
