@extends('layouts.home')
@section('content')
  {{-- Show apartment info --}}
  @include('layouts.header')
  <div class="show-apartment py-5">
    <div class="container head">
      <div class="row">
        <div class="col-lg-9">
          <div class="image-title-wrapper">
            <img class="picture"
            @if(file_exists(public_path('images/' . $apartment->image)))
              src="{{asset('images/' . $apartment->image)}}"
            @else
              src="{{$apartment->image}}"
            @endif
            >
            <div class="bg-title">
            <h4 class="image-title">{{$apartment->title}}</h4>
            </div>
          </div>
        </div>
        @if(Auth::user()!==null)
          @if($apartment->user_id==Auth::user()->id)
            <div class="col-lg-3 d-flex align-items-start justify-content-center">
              <a class="boolbnb-btn" href="{{route('showSponsorshipForm',$apartment->id)}}">Sponsorizza il tuo appartamento!</a>
            </div>
          @endif
        @endif
      </div>
    </div>
    <div class="container mt-4">
      <div class="row">
          <div class="upper-section d-flex col-lg-12 align-items-center justify-content-between">
            <div class="price">
             <h3 class="text-right">{{$apartment->price}}€ </h3> <small> per notte</small>
            </div>
            <div class="address-name">
              <i class="fas fa-map-marked-alt fa-3x mr-3"></i>
              <span>{{$apartment->address}}</span>
            </div>
          </div>
          <hr style="width: 100%">
        <div class="col-lg-7 my-4">
          <p>{{$apartment->description}}</p>
        </div>
        <div class="info-apartment col-lg-4 p-3 offset-lg-1">
<br>
          <ol class="text-center list-unstyled d-flex flex-start">
            <li><i class="fas fa-door-open fa-2x"></i><br> {{$apartment->number_of_rooms}} stanze</li>
            <li><i class="fas fa-bed fa-2x"></i><br> {{$apartment->bedrooms}} letti</li>
            <li><i class="fas fa-toilet fa-2x"></i><br> {{$apartment->bathrooms}} bagni</li>
            <li><i class="fas fa-ruler-combined fa-2x"></i><br> {{$apartment->square_meters}} mq</li>
          </ol>
        </div>
        <div class="servizi">
        <h2>Servizi</h2>
        <br>
        <ul>
          @foreach ($apartment->services as $service)
            <li class="mx-2">{{$service->name}} {!! $service->icon !!}</li>
          @endforeach
        </ul>
      </div>
      </div>
    </div>
    <hr style="width:80%">
    {{-- END Show apartment info --}}
    {{-- MAP SECTION --}}
    <div class="container mt-4">
      <div class="row">
        <div class="col-lg-6" data-lat={{$apartment->lat}} data-lng={{$apartment->lng}} id='map'></div>
        {{-- END MAP SECTION --}}
        {{-- Contact form --}}
          @auth
            @if ($apartment->user_id!=Auth::user()->id)

              <form class="create col-lg-6" action="{{route('create-message',$apartment->id)}}" method="post">
                @csrf

                <div class="d-flex justify-content-center align-items-center">
                  <div class="message-form-wrapper">

                    <h3>Scrivi al proprietario</h3><br>

                    <label for="title">Oggetto</label><br>
                    <input type="text" name="title" value=""><br>

                    <label for="content">Testo della Mail</label><br>
                    <textarea name="content" rows="10" cols="30"></textarea><br>

                    <button type="submit" class="boolbnb-btn" name="button">Send Mail</button>
                  </div>
                </div>
              </form>
            @endif
          @endauth

          @guest
            <form class="create col-lg-6" action="{{route('create-message',$apartment->id)}}" method="post">
              @csrf
              <div class="d-flex justify-content-center align-items-center">
                <div class="message-form-wrapper">

                  <h3>Scrivi al proprietario</h3><br>
                  <label for="email">indirizzo mail</label><br>
                  <input type="text" name="email" value=""><br>

                  <label for="title">Oggetto</label><br>
                  <input type="text" name="title" value=""><br>

                  <label for="content">Testo della Mail</label><br>
                  <textarea name="content" rows="10" cols="30"></textarea><br>

                  <button type="submit" class="boolbnb-btn" name="button">Send Mail</button>
                </div>
              </div>
            </form>

          @endguest
          <hr style="width:80%">
          {{-- END Contact form --}}

          @auth
            @if ($apartment->user_id==Auth::user()->id)

            <div class="messages">
              @if ($apartment->messages->count()==0)
                <h3 class="text-center">Non hai ricevuto messaggi per questo appartamento!</h3>
              @endif
              @foreach ($apartment->messages as $message)
                <div class="border">
                  <p>Oggetto: {{$message->title}}</p>
                  <h5>"{{$message->content}}"</h5>
                  <span>Inviato da: <a href="" data-mail={{$message->email}} data-title={{$apartment->title}} class="emailLink">{{$message->email}}</a></span>
                </div>
              @endforeach
            </div>

            @endif
          @endauth
      </div>
    </div>
    <hr style="width:80%">
    {{-- END Contact form --}}
    @if(Auth::user()!==null)
      @if($apartment->user_id==Auth::user()->id)
        <div class="chart-visual">
          <h3 class="text-center">Visualizzazioni totali: {{$apartment->visuals->count()}}</h3>
          <h3 class="text-center">Messaggi totali: {{$apartment->messages->count()}}</h3>
          <div class="">
          <canvas id="visualsChart" data-stats={{$visualsData}} data-months={{$months}}></canvas>
          </div>
          <div class="">
          <canvas id="messagesChart" data-stats={{$messagesData}} data-months={{$months}}></canvas>
          </div>
        </div>
      @endif
    @endif
  </div>
@stop
