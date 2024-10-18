@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="resources/css/welcome.css">
<link href="https://fonts.googleapis.com/css2?family=Jersey+10&display=swap" rel="stylesheet">
<style>

</style>
<div class="m-lg-auto m-md-auto col-sm-12 col-md-8 col-lg-8 d-flex flex-column">
  <div class="m-2 custom-text">
      <h1 class="d-flex justify-content-center ">
          Welcome to CS2 Grenades
      </h1>
      <p class="d-flex justify-content-center ">
        It's site made for Counter-Strike 2 players who want to improve tactical part of the game.
      </p>
      <p class="d-flex justify-content-center ">
        Check grenades added by our community and join us if you want to share or save for yourself.
      </p>
  </div>
  <div class="card-body col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center flex-column">
    <div class="m-3 row d-flex justify-content-center text-center">
      <h1 class="my-3">Active map pool:</h1>
      @foreach($mapsActive as $map)
        <div class="col-sm-auto m-1 p-0 map-card">
          <a  href="{{ route('maps.show', $map->id) }}">
            @if(empty($map->image_path))
              <img class="rounded" src="default" alt="error">
            @else
              <img class="rounded" src="{{ asset('storage/' . $map->image_path) }}" alt="{{$map->description}}">
            @endif
            <div class="map-name">{{ $map->name }}</div>
          </a>
        </div>
      @endforeach
      <h1 class="my-3">Other maps:</h1>
      @foreach($mapsOthers as $map)
      <div class="col-md-auto m-1 p-0 map-card">
        <a href="{{ route('maps.show', $map->id) }}">
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
    <div class="row g-2 d-flex justify-content-center">
      @foreach($grenades as $grenade)
          <div class="grenade-card col-md-3">
              <span class="text-md-center fs-6" onclick="window.location.href = '{{ route('grenade.show', $grenade->id) }}';" style="cursor:pointer">
                <b>{{ $grenade->map->name }}</b>
                {{ $grenade->areaTo->name}} 
                @if(isset($grenade->calloutTo->name))
                    -> {{ $grenade->calloutTo->name }}
                @endif
                <b>{{ $grenade->type }}</b>  
              </span> 
              <div class="m-1">
              @if($grenade->source_type === 'youtube_path')
              <div id="yt" class="d-flex justify-content-center align-items-center">
                  <iframe  class="mx-auto d-block img-fluid" alt="{{ $grenade->describtion }}" style="border-radius:5px;max-width: 100%; max-height: 100%" width="1920" height="1080" src="https://www.youtube.com/embed/{{ $grenade->youtube_path }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
              @elseif($grenade->source_type === 'images')
                @if($grenade->grenadeImages->count() > 0)
                    <div id="carouselExampleControls{{$grenade->id}}" class="carousel slide position-relative" data-bs-interval="false">
                          <div class="carousel-inner">
                              @foreach($grenade->grenadeImages as $key => $image)
                                  <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                                      <img src="{{ asset('storage/' . $image->path) }}" class="mx-auto d-block img-fluid" alt="{{ $grenade->describtion }}" style="border-radius:5px;max-width: 100%; max-height: 100%; quality: 90;">
                                  </div>
                              @endforeach
                          </div>
                          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls{{$grenade->id}}" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls{{$grenade->id}}" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                          </button>
                      </div>
                @endif
              @endif
              </div>                  
              <div class="my-1 d-flex flex-row justify-content-between px-3">
                <div class="like-grenade-footer">
                    <a href=""><i class="fa-solid fa-minus fa-sm" style="color: #f00000"></i></a>
                    <span class="fs-5">0</span>
                    <a href=""><i class="fa-solid fa-plus fa-sm" style="color: #00f068"></i></a>
                </div>
                <div class="favorite-grenade-footer">
                    <a href="#"><i class="fa-regular fa-star fa-sm"></i></a>
                    <span class="fs-5">0</span>
                </div>
                <div class="author-grenade-footer">
                    <span class="text-end">Added by: <b><a style="color: #f00000; text-decoration: none" href="{{route('users.show', $grenade->user->id)}}">{{$grenade->user->name}}</a></b></span>
                </div>
              </div> 
          </div>
      @endforeach

    </div>
</div>
@endsection