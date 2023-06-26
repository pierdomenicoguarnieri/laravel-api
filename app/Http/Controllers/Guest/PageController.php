<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public function index(){
    return view('guest.home');
  }

  public function projects(){
    $projects = Project::paginate(10);
    return view('guest.projects', compact('projects'));
  }

  public function project($slug){
    $project = Project::where('slug', $slug)->first();
    return view('guest.project', compact('project'));
  }
}
