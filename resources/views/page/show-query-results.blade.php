@extends('layouts.home')

@section('content-header')
  @include('layouts.header')
@stop

@section('content')
  <div id="app" data-lat="{{$lat}}" data-lon="{{$lon}}" data-address="{{$address}}"></div>
@stop
