<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class welcomecontroller extends Controller
{
  public function index(){
    return view('dashboard.welcome');
  }
}
