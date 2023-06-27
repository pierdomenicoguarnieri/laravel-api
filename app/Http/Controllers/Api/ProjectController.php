<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
  public function index(){
    $projects = Project::with('type', 'technologies')->paginate(15);

    return response()->json($projects);
  }

  public function getTypes(){
    $types = Type::all();

    return response()->json($types);
  }
}
