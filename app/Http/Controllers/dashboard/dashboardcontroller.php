<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dashboardcontroller extends Controller
{
  public function index(){
    return view('dashboard.index');
  }
}
