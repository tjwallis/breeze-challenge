<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Group extends Controller
{
  public function index() {
    return view('welcome', ['groups' => \App\Group::all()]);
  }

  public function show($id) {

  }

  public function import_csv($rows) {

    $this->CreateOrUpdate();

  }
}
