<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'type_id' => 'nullable',
      'title' => 'required|min:5|max:255',
      'image' => 'nullable|image',
      'description' => 'nullable|min:20',
      'start_date' => 'required|date_format:Y-m-d|date',
      'end_date' => 'nullable|date_format:Y-m-d|date',
      'technologies' => 'nullable',
      'commits' => 'numeric|min:0|max:255',
      'finished' => 'required|boolean',
    ];
  }

  public function messages(){
    return [
      'title.required' => 'Il titolo è obbligatorio',
      'title.min' => 'Il titolo deve contenere almeno :min caratteri',
      'title.max' => 'Il titolo deve contenere al massimo :max caratteri',
      'image.image' => 'Inserisci un file avente un formato valido.',
      'description.required' => 'La descrizione è obbligatoria',
      'description.min' => 'La descrizione deve contenere almeno :min caratteri',
      'start_date.required' => 'La data è obbligatoria',
      'start_date.date' => 'La data d\'inizio progetto non è valida',
      'start_date.date_format' => 'La data d\'inizio progetto deve avere un formato valido (YYYY-MM-DD)',
      'end_date.date' => 'La data di fine progetto non è valida',
      'end_date.date_format' => 'La data di fine progetto deve avere un formato valido (YYYY-MM-DD)',
      'commits.numeric' => 'I commit devono essere un numero',
      'commits.min' => 'I commit devono avere un valore minimo di :min',
      'commits.max' => 'I commit devono avere un valore massimo di :max',
      'finished.required' => 'Lo stato del progetto è richiesto',
      'finished.boolean' => 'Lo stato del progetto deve essere "Terminato" oppure "Non Terminato"',

    ];
  }
}
