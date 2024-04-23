@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jersey+10&display=swap" rel="stylesheet">
<style>
.rounded {
  height: 330px;
  width: auto;
  transition: transform 0.3s ease-in-out;
}

.map-card {
  position: relative;
  overflow: hidden;
}

.map-name {
      font-family: "Jersey 10", sans-serif;
      font-weight: 600;
      font-style: normal;
      font-size: 2.5rem;
      color: rgb(0, 0, 0);
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      text-align: center;
      box-sizing: border-box;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
    }

    .map-card:hover .rounded {
          transform: scale(1.19); /* Powiększamy obraz o 5% */
      }
    .map-card:hover .map-name {
            opacity: 1;
    }

</style>
<div class="container col-8 d-flex flex-column">
  <div class="card-header d-flex justify-content-center">
    <div class="welcome">
      <h1>
          Welcome to CS2 Grenades
      </h1>
      <p class="fs-3">
        It's site made for CounterStrike 2 players who want to improve tactical part of the game.
      </p>
      <p class="fs-3">
        Check grenades added by our community and join us if you want to share or save for yourself.
      </p>
      
    </div>
    <div class="px-5">
      <img src="{{ asset('storage/images/test/hey.png') }}" style="height: 200px; width: auto"alt="">
    </div>
  </div>
  <div class="card-body d-flex flex-column">
    <div class="py-5 row d-flex justify-content-center">
      <h1>Active map pool:</h1>
      @foreach($mapsActive as $map)
        <div class="col-md-auto m-0 p-0 border border-2 border-white map-card">
          <a class="m-1" href="{{ route('maps.show', $map->id) }}">
            @if(empty($map->image_path))
              <img class="rounded" src="default" alt="error">
            @else
              <img class="rounded" src="{{ asset('storage/' . $map->image_path) }}" alt="{{$map->description}}">
            @endif
            <div class="map-name">{{ $map->name }}</div>
          </a>
        </div>
      @endforeach
      <h1>Other maps:</h1>
      @foreach($mapsOthers as $map)
      <div class="col-md-auto m-0 p-0 border border-2 border-white map-card">
        <a class="card" href="{{ route('maps.show', $map->id) }}">
          @if(empty($map->image_path))
            <img class="rounded" src="default" alt="error">
          @else
            <img class="rounded" src="{{ asset('storage/' . $map->image_path) }}" alt="{{$map->description}}">
          @endif
          <div class="map-name">{{ $map->name }}</div>
        </a>
      </div>
    @endforeach
    </div>
    <h1>Recently added:</h1>
    <div class="d-flex flex-wrap justify-content-center">
      @foreach($grenades as $grenade)
          <div class="card d-flex flex-column m-1">
              <span class="text-md-center fs-5">
                <b>{{ $grenade->map->name }}</b>
                {{ $grenade->areaTo->name}} 
                @if(isset($grenade->calloutTo->name))
                    -> {{ $grenade->calloutTo->name }}
                @endif
                <b>{{ $grenade->type }}</b>  
              </span> 
              <div class="box m-2 text-center d-flex flex-column justify-content-between" style="height: 210px; width: 280px; background-color:red"> 
              </div>
              <div class="my-2 d-flex flex-row justify-content-between px-3">
                <div class="like-grenade-footer">
                    <a href=""><i class="fa-solid fa-minus fa-sm" style="color: #f00000"></i></a>
                    <span class="fs-5">0</span>
                    <a href=""><i class="fa-solid fa-plus fa-sm" style="color: #00f068"></i></a>
                </div>
                <div class="favorite-grenade-footer">
                    <a href=""><i class="fa-regular fa-star fa-sm"></i></a>
                    <span class="fs-5">0</span>
                </div>
                <div class="author-grenade-footer">
                    <span class="text-end">Added by: <b style="color: #f00000">{{$grenade->user->name}}</b></span>
                </div>
              </div> 
          </div>
      @endforeach

    </div>
</div>
@endsection