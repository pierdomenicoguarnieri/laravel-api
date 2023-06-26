@extends('layouts.guest')

@section('title')
  Home
@endsection

@section('content')
  <main class="bg-dark text-white">
    <div class="container d-flex align-items-center flex-column py-5">
      <h1 class="mb-4">Dettagli di "{{$project->title}}"</h1>

      <a href="{{route('projects')}}" class="btn btn-primary mb-4">Torna alla lista</a>

      <div class="pg-table-wrapper rounded-2 border border-1 overflow-hidden shadow-sm">
        <table class="table m-0">
          <tbody>
            <tr>
              <th scope="row" class="w-25 border border-end">Title</th>
              <td>{{$project->title}}</td>
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
                <ul>
                  @foreach (explode("|", $project->used_languages) as $language)
                    <li>{{$language}}</li>
                  @endforeach
                </ul>
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
  </main>
@endsection
