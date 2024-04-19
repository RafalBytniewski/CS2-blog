@extends('layouts.app')
@section('content')
<style>
  .card-img{
    height: 330px;
    width: auto;
  }
  .card-img:hover{
    height: 350px;
  }

  
</style>
<div class="container col-8 d-flex flex-column">
  <div class="card-header d-flex justify-content-center">
    <div class="welcome">
      <h1>
          Welcome to CS2 Nades
      </h1>
      <p class="fs-3">
        It's site made for Counter Strike 2 playes who want to improve tactical ... of game.
      </p>
      <p class="fs-3">
        Check grenades added by our community and join us if you want to share!
      </p>
      
    </div>
    <div class="px-5">
      <img src="{{ asset('storage/images/test/hey.png') }}" style="height: 200px; width: auto"alt="">
    </div>
  </div>
  <div class="card-body d-flex flex-column">
    <div class="py-5 row d-flex justify-content-center">
      <h1>Activce maps</h1>
      @foreach($maps as $map)
        <div class="col-md-auto m-0 p-0 border border-2 border-white">
          <a class="card" href="{{ route('maps.show', $map->id) }}">
            @if(empty($map->image_path))
              <img class="card-img" src="default" alt="error">
            @else
              <img class="card-img" src="{{ asset('storage/' . $map->image_path) }}" alt="{{$map->describtion}}">
            @endif
          </a>
        </div>
      @endforeach
      <h1>Others maps</h1>
      <h1>-</h1>
    </div>
    <div class="d-flex flex-wrap justify-content-center">
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
      <div class="box m-2" style="height: 210px; width: 280px; background-color: red;">
        <h1 class="d-flex justify-content-center">1</h1>
      </div>
    </div>
</div>
@endsection