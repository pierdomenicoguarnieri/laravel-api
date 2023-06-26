@extends('layouts.admin')

@section('title')
  {{$title}}
@endsection

@section('content')
<div class="container py-4">
  <h2 class="fs-4 text-secondary mb-4">
    {{$title}}
  </h2>

  <form action="{{$route}}" method="POST" enctype="multipart/form-data">
    @csrf

    @method($method)

    @if($errors->any())

      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>

    @endif

    <div class="mb-3">
      <label for="type_id" class="form-label">Tipo</label>
        <select class="form-select @error('type_id') is-invalid @enderror" name="type_id">
          <option selected value="">Open this select menu</option>
          @foreach ($types as $type)
          <option value="{{$type?->id}}" @if($type?->id == old('type_id', $project?->type?->id)) selected @endif>{{$type?->name}}</option>
          @endforeach
        </select>
        @error('type_id')
          <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input
        type="text"
        class="form-control @error('title') is-invalid @enderror"
        placeholder="Titolo"
        name="title"
        value="{{old('title', $project?->title)}}">
        @error('title')
          <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Scegli un'immagine:</label>
      <input
        type="file"
        class="form-control @error('image') is-invalid @enderror"
        name="image"
        onchange="showImg(event)"
        value="{{old('image', $project?->image_original_name)}}">
        <img src="{{asset('storage/' . $project?->image_path)}}" id="image" width="200" alt="" class="mt-4" onerror="this.src='/img/no-image.jpg'">
        @error('image')
          <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Descrizione</label>
      <textarea
        type="text"
        id="description"
        class="form-control @error('description') is-invalid @enderror"
        placeholder="Descrizione"
        name="description">{{old('description', $project?->description)}}</textarea>
        @error('decription')
          <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
      <label for="start_date" class="form-label">Data d'inizio</label>
      <input
        type="text"
        class="form-control @error('start_date') is-invalid @enderror"
        placeholder="YYYY-MM-DD"
        name="start_date"
        value="{{old('start_date', $project?->start_date)}}">
        @error('start_date')
          <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
      <label for="end_date" class="form-label">Data di fine</label>
      <input
        type="text"
        class="form-control @error('end_date') is-invalid @enderror"
        placeholder="YYYY-MM-DD"
        name="end_date"
        value="{{old('end_date', $project?->end_date)}}">
        @error('end_date')
          <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
      <p for="category_id" class="form-title">Linguaggi Usati</p>
      <div class="btn-group" role="group">

        @foreach ($technologies as $technology)
          <input type="checkbox" class="btn-check" id="technology{{$loop->iteration}}" autocomplete="off" value="{{$technology->id}}" name="technologies[]"
          @if(!$errors->any() && $project?->technologies?->contains($technology))
            checked
          @elseif($errors->any() && in_array($technology->id, old('technologies', [])))
            checked
          @endif>
          <label class="btn btn-outline-secondary" for="technology{{$loop->iteration}}">{{$technology->name}}</label>
        @endforeach

      </div>
        @error('technologies')
          <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
      <label for="commits" class="form-label">Commits</label>
      <input
        type="number"
        class="form-control @error('commits') is-invalid @enderror"
        placeholder="0"
        name="commits"
        value="{{old('commits', $project?->commits)}}">
        @error('commits')
          <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
      <label for="finished" class="form-label">Stato del progetto</label>
      <select class="form-select @error('finished') is-invalid @enderror" id="finished" name="finished">
        <option selected>Scegli una opzione</option>
        <option value="1" @if($project->finished) selected @endif>Terminato</option>
        <option value="0" @if(!$project->finished) selected @endif>Non Terminato</option>
      </select>
      @error('finished')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <button type="submit" class="btn btn-success mb-5">{{$msg_button}}</button>
  </form>
</div>

<script>
  ClassicEditor
    .create(document.querySelector('#description'))
    .catch(error => {
      console.error(error);
    });

  function showImg(event){
    const tagImage = document.getElementById('image');
    tagImage.src = URL.createObjectURL(event.target.files[0]);
  }
  </script>
@endsection
