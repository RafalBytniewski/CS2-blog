@extends('layouts.app')
@section('content')

<div class="container">
  <div class="card-body">
    <div class="card welcome">
      <h1>
          Welcome to CS2 Nades
      </h1>
      <p class="fs-3">
        Check grenades added by our community and join us if you want to share your nades.
      </p>
      
    </div>
  <div class="container"> 
    <section class="pt-5 pb-5">
      <div class="container w-100">
        <div class="row align-content-center">
          @foreach($maps as $map)
            <a class="card p-2 col-md-3  no-gutters text-black" href="{{ route('maps.show', $map->id) }}"xa>
              @if(empty($map->image_path))
                <img class="card-img h-100 shadow" src="" alt="{{$map->describtion}}">
              @else
                <img class="card-img h-100 shadow" src="{{ asset('storage/' . $map->image_path) }}" alt="{{$map->describtion}}">
              @endif 
                <div class="card-img-overlay p-1 d-flex  flex-column  align-items-baseline justify-content-center ">
                <div class="container-fluid  h-50  text-center">
                  <div class="row h-100 align-items-center">
                    <div class="col-12">
                      <h1 class="mt-5 mb-3">{{$map->name}}</h2>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </section>
  </div>
</div>
@endsection