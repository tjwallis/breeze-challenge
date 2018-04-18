<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Group extends Controller
{
  public function index() {
    return view('welcome', ['groups' => \App\Group::all()]);
  }

  public function listPeople($id) {
    $group = \App\Group::findOrFail($id);
    $people = $group->people()->where('status', 1)->get();

    return response()->json($people->toArray());
  }

}
