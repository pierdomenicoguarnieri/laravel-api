<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $technologies = Technology::all();
    return view('admin.technologies.index', compact('technologies'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $new_technology = new Technology();
    $val_data = $request->validate(
      [
        'name' => 'required|unique:types|max:50'
      ]
    );
    $val_data['slug'] = Str::slug($val_data['name'], '-');
    $new_technology->fill($val_data);
    $new_technology->save();
    return redirect()->back()->with('message', "Hai creato correttamente la tecnologia $new_technology->name");
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Technology $technology)
  {
    $val_data = $request->validate(
      [
        'name' => 'required|unique:types|max:50'
      ]
    );
    $val_data['slug'] = Str::slug($val_data['name'], '-');
    $technology->update($val_data);
    return redirect()->back()->with('message', "Hai modificato correttamente la tecnologia $technology->name");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Technology $technology)
  {
    $technologies = Technology::all();
    $technology->delete();
    return redirect()->route('admin.technologies.index', compact('technologies'))->with('deleted', "La tecnologia '$technology->title' è stata eliminata correttamente");
  }
}
