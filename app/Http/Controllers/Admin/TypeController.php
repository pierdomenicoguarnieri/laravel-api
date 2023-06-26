<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $types = Type::all();
    return view('admin.types.index', compact('types'));
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
    $new_type = new Type();
    $val_data = $request->validate(
      [
        'name' => 'required|unique:types|max:50'
      ]
    );
    $val_data['slug'] = Str::slug($val_data['name'], '-');
    $new_type->fill($val_data);
    $new_type->save();
    return redirect()->back()->with('message', "Hai creato correttamente il tipo $new_type->name");
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
  public function update(Request $request, Type $type)
  {
    $val_data = $request->validate(
      [
        'name' => 'required|unique:types|max:50'
      ]
    );
    $val_data['slug'] = Str::slug($val_data['name'], '-');
    $type->update($val_data);
    return redirect()->back()->with('message', "Hai modificato correttamente la categoria $type->name");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Type $type){
    $types = Type::all();
    $type->delete();
    return redirect()->route('admin.types.index', compact('types'))->with('deleted', "Il tipo '$type->title' è stato eliminato correttamente");
  }
}
