@extends('layouts.admin')

@section('title')
  Index
@endsection

@section('content')
<div class="container py-4">
  <h2 class="fs-4 text-secondary mb-4">
    Projects Index
  </h2>

    @if(session('deleted'))
      <div class="alert alert-success mb-4" role="alert">
        {{session('deleted')}}
      </div>
    @endif

  <div class="pg-table-wrapper rounded-2 border border-1 overflow-hidden shadow-sm mb-4">
    <table class="table mb-0">
      <thead>
        <tr>
          <th scope="col" class="text-center">
            <a class="text-black text-decoration-none" href="{{route('admin.orderBy', ['direction' => $direction])}}">
              #ID
              @if ($direction === 'asc')
                <i class="fa-solid fa-chevron-up ms-2"></i>
              @else
                <i class="fa-solid fa-chevron-down ms-2"></i>
              @endif
            </a>
          </th>
          <th scope="col">Title</th>
          <th scope="col" class="text-center">Finished</th>
          <th scope="col" class="text-center">Type</th>
          <th scope="col" class="text-center">Technologies</th>
          <th scope="col" class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($projects as $project)
        <tr>
          <th scope="row" class="text-center">{{$project->id}}</th>
          <td>{{$project->title}}</td>
          <td class="text-center">
            @if ($project->finished)
              <i class="fa-solid fa-check" style="color: #26a269;"></i>
            @else
            <i class="fa-solid fa-x" style="color: #e01b24;"></i>
            @endif
          </td>
          <td class="text-center"><span class="badge text-bg-primary">{{$project->type?->name}}</span></td>
          <td class="text-center">
            @forelse ($project->technologies as $technology)
              <span class="badge text-bg-warning">{{$technology->name}}</span>
            @empty
              <span class="badge text-bg-danger">No Technologies</span>
            @endforelse
          </td>
          <td class="text-center">
            <a href="{{route('admin.projects.show', $project)}}" class="btn btn-primary" title="Show"><i class="fa-solid fa-eye"></i></a>
            <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning" title="Edit"><i class="fa-solid fa-pencil"></i></a>
            @include('admin.partials.modal', [
              'name' => $project->title,
              'id' => $project->id,
              'route' => route('admin.projects.destroy', $project),
              'type' => 'progetto'
            ])
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div>
    {{$projects->links()}}
  </div>
</div>
@endsection
