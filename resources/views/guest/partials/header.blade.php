<header>
  <nav class="navbar bg-dark border-bottom border-bottom-dark navbar-expand-lg shadow-sm" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('home')}}">
        <img src="/img/logo.png" alt="Logo" width="40" class="d-inline-block align-text-top">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link {{Route::currentRouteName() === 'home' ? 'active' : ''}}" href="{{route('home')}}">Home</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="{{route('projects')}}" class="nav-link {{Route::currentRouteName() === 'projects' ? 'active' : ''}}">Lista dei progetti</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
