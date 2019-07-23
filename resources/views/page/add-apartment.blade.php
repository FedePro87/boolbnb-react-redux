@extends('layouts.home')
@section('content')
  @include('layouts.header')


  <div class="container my-container">
    @auth
      <h1 class="text-center">Inserisci il nuovo appartamento</h1>
      <form enctype="multipart/form-data" class="form-add" action="{{route('save')}}" method="post">
        @csrf


        <div class="title-container">
          <label for="title">Title</label><br>
          <input class="w-75"type="text" name="title" value=""><br>
        </div>
        <div class="image-cont">

          <label class="mt-3" >Add image</label><br>
          <input type="file" name="image" id="upload-image">
        </div>

        <br>
        <div class="description-container">

          <label for="description">Description</label>
          <br>
          <textarea name="description" class="col-lg-12 col-md-6">{{ old('description')}}</textarea>


        </div>


        <div class="price-cont">
          <label for="price">Price</label>
          <br>
          <input type="number" name="price" value="{{ old('price')}}">
        </div>

        <br>



        <div class="square_meters">
          <label for="square_meters">Square Meters</label>
          <br>
          <input type="number" name="square_meters" value="{{ old('square_meters')}}">
        </div>

        <div class="address position-relative mt-3">
          <label for="address">Address</label>
          <br>
          {{-- <input class="address-search" type="text" name="address">
          <div class="query-results position-absolute bg-light"></div> --}}
          <div id="address-search-component-wrapper">
            <address-search-component :home-search=true></address-search-component>
          </div>

        </div>

        <br>
        <div class="container-select d-flex">
          {{-- ROOMS --}}
          <div class="rooms mr-5 d-flex flex-column">
            <label for="number_of_rooms">Rooms</label><br>
            <select name="number_of_rooms">

              @for ($i=1; $i<=10; $i++)
                {
                  <option value="{{$i}}">{{$i}}</option>
                }
              @endfor

            </select>
          </div>
          <br>

          {{-- BATHROOMS --}}
          <div class="bathrooms mr-5 d-flex flex-column">
            <label for="bathrooms">Bathrooms</label><br>
            <select name="bathrooms">

              @for ($i=1; $i<=10; $i++)
                {
                  <option value="{{$i}}">{{$i}}</option>
                }
              @endfor

            </select>
          </div>
          <br>

          {{-- BEDROOMS --}}
          <div class="bedrooms mr-5 d-flex flex-column">
            <label for="bedrooms">Bedrooms</label><br>
            <select name="bedrooms">
              @for ($i=1; $i<=10; $i++)
                {
                  <option value="{{$i}}">{{$i}}</option>
                }
              @endfor
            </select>
          </div>
        </div>
        <br>

        <div class="checkbox-cont col-lg-12">
          <label for="services">Services</label>
          <br>
          @foreach ($services as $service)
            <input class="service-input" type="checkbox" name="services[]" value="{{$service->id}}"><small>{{$service->name}}</small>
            <br>
          @endforeach
        </div>
        <br>
        <div class="button-box d-flex justify-content-center">

          <button id="save-apartment" type="submit" name="button">Save New Apartment</button>
        </div>

      </div>
    </form>
  @endauth
  @guest
    <h1>Devi essere loggato per aggiungere un appartamento!</h1>
  @endguest

@endsection
