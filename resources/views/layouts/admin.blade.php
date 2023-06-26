<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Boolfolio | @yield('title')</title>

    <link rel="shortcut icon" href="/img/logo.png" type="png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.css' integrity='sha512-Z0kTB03S7BU+JFU0nw9mjSBcRnZm2Bvm0tzOX9/OuOuz01XQfOpa0w/N9u6Jf2f1OAdegdIPWZ9nIZZ+keEvBw==' crossorigin='anonymous'/>

    {{-- CK Editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>


    <!-- Usando Vite -->
    @vite(['resources/js/admin.js'])
  </head>

  <body>

    @include('admin.partials.header')

    <main class="d-flex">
      @auth
        @include('admin.partials.aside')
      @endauth

      <div class="pg-content-wrapper">
        @yield('content')
      </div>
    </main>

  </body>

</html>
