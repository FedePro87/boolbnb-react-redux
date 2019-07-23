<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" sizes="192x192" href="https://a0.muscache.com/airbnb/static/icons/android-icon-192x192-c0465f9f0380893768972a31a614b670.png">

  {{-- ADD MY STYLE --}}
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  {{-- ADD MY JS --}}
  <script src="{{ mix('js/app.js') }}" charset="utf-8"></script>

  <title>BoolBnB</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <!-- Handlebars -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.0/handlebars.min.js" charset="utf-8"></script>

  <link rel="stylesheet" href="{{ asset('tomtom-sdk/map.css') }}">
  <script src="{{ asset('tomtom-sdk/tomtom.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('dropin.min.js')}}" type="text/javascript"></script>

  <script id="hand-apartment-template" type="text/x-handlebars-template">
    <div class="apartment col-lg-2">
      <div class="apartment-wrapper">
        <a href="/show/@{{id}}">
          <div>
            @if (file_exists(public_path('/images/@{{image}}')))
            <img src='/images/@{{image}}' class="img-fluid"/>
            @else
            <img src='@{{image}}' class="img-fluid">
            @endif
          </div>

          <div class="content-apartment">
            <span class="description">@{{title}}</span><br>
            <span class="address">@{{address}}</span><br>
            <span class="visuals">@{{visualized}} visualizzazioni</span><br>
          </div>
        </div>
      </div>
    </script>
  </head>
  <body>
    {{-- ERROR CONTROL --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if(session('success'))
      <div class="alert alert-success">
        <div class="container">

          {{session ('success')}}

        </div>
      </div>
    @endif
    {{-- END ERROR CONTROL --}}

    @yield('content-header')

    <div class="bigContainer">
      @yield('content')
    </div>

    @include('layouts.footer')
  </body>
  </html>
