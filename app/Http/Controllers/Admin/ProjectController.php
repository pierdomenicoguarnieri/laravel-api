<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $direction = 'asc';
      $projects = Project::orderBy('id', $direction)->paginate(10);
      return view('admin.projects.index', compact('projects', 'direction'));
    }

    public function orderBy($direction){
      $direction = $direction === 'asc' ? 'desc' : 'asc';
      $projects = Project::orderBy('id', $direction)->paginate(10);
      return view('admin.projects.index', compact('projects', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $route = route('admin.projects.store');
      $method = 'POST';
      $title = 'Crea un progetto';
      $msg_button = 'Crea';
      $project = null;
      $types = Type::all();
      $technologies = Technology::all();
      return view('admin.projects.create_edit', compact('route', 'method', 'title','msg_button', 'project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request){
      $form_data = $request->all();

      $form_data['slug'] = Project::generateSlug($form_data['title']);

      if(array_key_exists('image', $form_data)){
        $form_data['image_path'] = Storage::put('uploads', $form_data['image']);
        $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
      }

      $new_project = new Project();

      $new_project->fill($form_data);

      $new_project->save();

      if(array_key_exists('technologies', $form_data)){
        // Attacco al post appena creato l'array dei tags proveniente dal form
        $new_project->technologies()->attach($form_data['technologies']);
      }

      return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project){
      return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project){
      $route = route('admin.projects.update', $project);
      $method = 'PUT';
      $msg_button = 'Modifica';
      $title = 'Modifica il progetto: "' . $project->title . '"';
      $types = Type::all();
      $technologies = Technology::all();
      return view('admin.projects.create_edit', compact('route', 'method', 'title', 'msg_button', 'project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project){

      $form_data = $request->all();

      if($form_data['title'] !== $project->title){
        $form_data['slug'] = Project::generateSlug($form_data['title']);
      }else{
        $form_data['slug'] = $project->slug;
      }

      if(array_key_exists('image', $form_data)){
        $form_data['image_path'] = Storage::put('uploads', $form_data['image']);
        $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
      }else{
        $project->technologies()->detach();
      }

      if(array_key_exists('technologies', $form_data)){
        // Attacco al post appena creato l'array dei tags proveniente dal form
        $project->technologies()->attach($form_data['technologies']);
      }

      $project->update($form_data);

      return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project){
      if($project->image_path){
        Storage::disk('public')->delete($project->image_path);
      }
      $project->delete();
      return redirect()->route('admin.projects.index')->with('deleted', "Il progetto '$project->title' è stato eliminato correttamente");
    }
}
