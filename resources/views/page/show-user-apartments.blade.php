@extends('layouts.home')
@section('content')
  @include('layouts.header')

  <h1 class="text-center mt-5">I miei Appartamenti</h1>

  @include ('components.apartment-component')

  <div class="container-fluid mt-4">
    <div id="apartment-component-wrapper" class="d-flex flex-wrap justify-content-center">

      @foreach ($user->apartments as $apartment)
        <apartment-component description="{{$apartment->title}}" image={{$apartment->image}} alt-image="{{asset('images/' . $apartment->image)}}" address="{{$apartment->address}}" v-bind:visuals="{{$apartment->visuals->count()}}" v-bind:messages="{{$apartment->messages->count()}}" show-index="{{route('show',$apartment->id)}}"></apartment-component>
      @endforeach

    </div>
  </div>

@stop
