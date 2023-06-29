<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
  public function store(Request $request){
    $data = $request->all();

    $validator = Validator::make($data,
      [
        'title' => 'required|min:3|max:255',
        'email' => 'required|email|min:5|max:255',
        'message' => 'required|min:10'
      ],
      [
        'title.required' => 'Il titolo è richiesto',
        'title.min' => 'Il titolo deve avere almeno :min caratteri',
        'title.max' => 'Il titolo può avere al massimo :max caratteri',
        'email.required' => 'L\'email è richiesta',
        'email.email' => 'L\'email inserita non ha un formato corretto',
        'email.min' => 'L\'email deve avere almeno :min caratteri',
        'email.max' => 'L\'email può avere al massimo :max caratteri',
        'message.required' => 'Il messaggio è richiesto',
        'message.min' => 'Il messaggio può avere al massimo :max caratteri',
      ]
    );

    if($validator->fails()){
      $success = false;
      $errors = $validator->errors();
      return response()->json(compact('success', 'errors'));
    }

    $success = true;
    return response()->json(compact('success'));
  }
}
