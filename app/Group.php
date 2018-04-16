<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  // Groups have many persons
  public function people() {
    return $this->hasMany('App\Person', 'person_id');
  }


  public function import($records) {
    $imported = array();
    foreach($records as $row) {
      try {
        Group::updateOrCreate(['group_id' => $row->group_id, $row->toArray());
      } catch( exception $e) {
        render($e);
        $imported[$row->group_id] = false;

        return false;
      }
    }

    return $imported;
  }
}
