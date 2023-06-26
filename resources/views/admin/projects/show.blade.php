@extends('layouts.admin')

@section('title')
  Show {{$project->title}}
@endsection

@section('content')
<div class="container py-4">
  <h2 class="fs-4 text-secondary mb-4 d-inline">
    Show "{{$project->title}}"
  </h2>
  <div class="d-inline">
    <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning ms-2" title="Edit"><i class="fa-solid fa-pencil"></i></a>
    @include('admin.partials.modal', [
      'name' => $project->title,
      'id' => $project->id,
      'route' => route('admin.projects.destroy', $project),
      'type' => 'progetto'
    ])
  </div>

  <div class="mt-4">
    <a href="{{route('admin.projects.index')}}" class="btn btn-primary mb-4">Torna all'index</a>
  </div>

  <div class="pg-table-wrapper rounded-2 border border-1 overflow-hidden shadow-sm">
    <table class="table m-0">
      <tbody>
        <tr>
          <th scope="row" class="w-25 border border-end">Title</th>
          <td>{{$project->title}}</td>
        </tr>
        <tr>
          <th scope="row" class="w-25 border border-end">Tipo</th>
          <td><span class="badge text-bg-primary">{{$project->type?->name}}</span></td>
        </tr>
        <tr>
          <th scope="row" class="w-25 border border-end">Image</th>
          <td><img width="200" src="{{asset('storage/' . $project->image_path)}}" alt="{{$project->title}}" title="{{$project->title}}" onerror="this.src='/img/no-image.jpg'"></td>
        </tr>
        <tr>
          <th scope="row" class="w-25 border border-end">Description</th>
          <td>{!!$project->description!!}</td>
        </tr>
        <tr>
          <th scope="row" class="w-25 border border-end">Slug</th>
          <td>{{$project->slug}}</td>
        </tr>
        <tr>
          <th scope="row" class="w-25 border border-end">Data d'inizio</th>
          <td>{{$project->start_date}}</td>
        </tr>
        @if ($project->end_date)
          <tr>
            <th scope="row" class="w-25 border border-end">Data di fine</th>
            <td>{{$project->end_date}}</td>
          </tr>
        @endif
        <tr>
          <th scope="row" class="w-25 border border-end">Linguaggi usati</th>
          <td>
            @forelse ($project->technologies as $technology)
            <span class="badge text-bg-warning">{{$technology->name}}</span>
            @empty
            <span class="badge text-bg-danger">No Technologies</span>
            @endforelse
          </td>
        </tr>
        <tr>
          <th scope="row" class="w-25 border border-end">Numero di commits</th>
          <td>{{$project->commits}}</td>
        </tr>
        <tr>
          <th scope="row" class="w-25 border border-end">Progetto finito</th>
          <td>
            @if ($project->finished)
              <i class="fa-solid fa-check" style="color: #26a269;"></i>
            @else
              <i class="fa-solid fa-x" style="color: #e01b24;"></i>
            @endif
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</div>
@endsection
