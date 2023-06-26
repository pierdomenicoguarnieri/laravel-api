@extends('layouts.guest')

@section('title')
  Home
@endsection

@section('content')
  <main class="bg-dark text-white">
    <div class="container-fluid d-flex align-items-center flex-column py-5">
      <h1 class="mb-4">Lista dei progetti</h1>

      <div class="pg-table-wrapper rounded-2 border border-1 overflow-hidden shadow-sm mb-4 w-75">
        <table class="table m-0">
          <thead>
            <tr>
              <th scope="col" class="text-center">#ID</th>
              <th scope="col">Title</th>
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th scope="col" class="text-center">Finished</th>
              <th scope="col" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($projects as $project)
            <tr>
              <th scope="row" class="text-center">{{$project->id}}</th>
              <td>{{$project->title}}</td>
              <td>
                @php
                  $date = date_create($project->start_date);
                  echo date_format($date, 'd/m/Y');
                @endphp
              </td>
              <td>
                @if ($project->end_date)
                  @php
                    $date = date_create($project->end_date);
                    echo date_format($date, 'd/m/Y');
                  @endphp
                @else
                  <span class="text-danger">No date</span>
                @endif
              </td>
              <td class="text-center">
                @if ($project->finished)
                  <i class="fa-solid fa-check" style="color: #26a269;"></i>
                @else
                <i class="fa-solid fa-x" style="color: #e01b24;"></i>
                @endif
              </td>
              <td class="text-center">
                <a href="{{route('project', ['slug' => $project->slug])}}" class="btn btn-primary" title="Show"><i class="fa-solid fa-eye"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="w-75">
        {{$projects->links()}}
      </div>
    </div>
  </main>
@endsection
