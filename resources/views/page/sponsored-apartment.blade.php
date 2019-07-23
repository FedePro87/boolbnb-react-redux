@extends('layouts.home')

{{-- Ricerca --}}
@section('content-header')
  <div class="main-header">
    <div class="navbar-wrapper">
      @include('layouts.header')
    </div>
    <div class="bg-form-wrapper">


      <div class="form-style col-lg-4 col-md-9">
        @guest
          <h1>Ciao, dove vuoi andare?</h1>
        @endguest
        @if(Auth::user()!==null)
          <h1>Ciao {{ Auth::user()->firstname }}, dove vorresti andare?</h1>
        @endif

        <form action="{{route('apartment-search')}}" method="get">
          <div id="home"></div>
          <div class="form-group">
          </div>
          <input class="boolbnb-btn" type="submit" name="" value="SEARCH">
        </form>

      </div>
    </div>

  </div>
@stop

@section('content')
  <div class="container-fluid mt-5">
    <div id="apartments-component-wrapper" data-sponsoreds="all" class="d-flex flex-wrap justify-content-center"></div>
  </div>

@stop
