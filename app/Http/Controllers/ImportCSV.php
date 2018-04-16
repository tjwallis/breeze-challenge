<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class ImportCSV extends Controller
{
  // Proccess the user uploaded CVS file and calls the correct import function.
  public function __invoke(Request $request) {
    $results = null;
    $imported = array();
    $validator = $request->validate([
      'csv_file' => 'required|file',
      'has_header' => 'required',
    ]);

    Excel::load($request->file('csv_file')->getRealPath(), function($reader) {
      $results = $reader->all();
      $row = $reader->first();

      // Deterime if the cvs is for Groups or People. Fail if it is not.
      if($row->has('group_name') && $row->has( 'group_id' )) {
        $imported = \App\Group::import($results);
      } elseif($row->has('person_id') && $row->has['email']) {
        $imported = \App\Person::import($results);
      } else {

        return redirect('/import')
                        ->withErrors(Array('CVS Headers do not match expected data for a Group or Person export.'))
                        ->withInput();
        die();
      }
    });

    return response()->json([$imported, $results]);

  }
}
