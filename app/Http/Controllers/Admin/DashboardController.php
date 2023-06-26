<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index(){
    $n_projects = Project::all()->count();
    $last_projects = Project::orderBy('id', 'desc')->take(5)->get();
    return view('admin.home', compact('n_projects', 'last_projects'));
  }
}
