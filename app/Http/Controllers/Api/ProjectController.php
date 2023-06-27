<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
  public function index(){
    $projects = Project::with('type', 'technologies')->paginate(15);

    return response()->json($projects);
  }

  public function getByType($id){
    $projects = Project::where('type_id', $id)->with('type', 'technologies')->paginate(15);

    return response()->json($projects);
  }

  public function getByTechnology($id){
    $projects = Project::whereHas('technologies', function($query)use($id){
      $query->where('technology_id', $id);
    })->with('type', 'technologies')->paginate(15);

    return response()->json($projects);
  }

  public function getTypes(){
    $types = Type::all();

    return response()->json($types);
  }

  public function getTechnologies(){
    $technologies = Technology::all();

    return response()->json($technologies);
  }
}
