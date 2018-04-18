<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class ImportCSV extends Controller
{
  // Proccess the user uploaded CVS file and calls the correct import function.
  public function __invoke(Request $request) {
    $imported = array();
    $validator = \Validator::make($request->all(), [
      'csv_file' => 'required|file',
      'has_header' => 'required',
    ]);

    if ($validator->fails()) {
      //pass validator errors as errors object for ajax response
      return response()->json(['errors'=>$validator->errors()], 422);
    }

    $results = Excel::load($request->file('csv_file')->getRealPath(), function($reader) {
    })->all();

      $row = $results->first();

      // Deterime if the cvs is for Groups or People. Fail if it is not.
      if($row->has('group_name') && $row->has( 'group_id' )) {
        $imported = $this->importGroup($results);
        return response()->json([$imported]);
      } elseif($row->has('person_id') && $row->has('email_address')) {
        $imported = $this->importPeople($results);
        return response()->json([$imported]);
      }

      return response()->json((object)['errors' => ['Headers Do not match expected group or people csv']], 422);
  }

  private function importGroup($records) {
    $imported = array();
    foreach($records as $row) {
      try {
        $imported[] = \App\Group::updateOrCreate(['group_id' => $row->group_id], $row->toArray());
      } catch( exception $e) {
        render($e);
        $imported[$row->group_id] = false;

        return false;
      }
    }

    return $imported;
  }

  private function importPeople($records) {
    $imported = array();
    foreach($records as $row) {
      try {
        $imported[] = \App\Person::updateOrCreate(['person_id' => intval($row->person_id)], ['group_id' => $row->group_id, 'person_id' => $row->person_id, 'first_name' => $row->first_name, 'last_name' => $row->last_name, 'status' => $row->state, 'email' => $row->email_address ]);
      } catch( exception $e) {
        render($e);
        $imported[$row->person_id] = false;

        return false;
      }
    }

    return $imported;

  }
}
