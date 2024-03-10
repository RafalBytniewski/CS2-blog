@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header">
        <h1 style="text-align:center">{{$maps->name}}</h1>
        <a href="{{ route('maps.create', $maps->id) }}">
            <button class="btn btn-lg btn-outline-primary">
                Add grenade
            </button>
        </a>
    </div>
    <div class="card-body">
        @foreach($grenades as $grenade)
        <div class="card">
            <span>User name: {{$grenade->user->name}}</span>
            @if(isset($grenade->calloutFrom->name))
                <span>Callout from: {{ $grenade->calloutFrom->name }}</span>
            @endif
            @if(isset($grenade->calloutTo->name))
                <span>Callout to: {{ $grenade->calloutTo->name }}</span>
            @endif
            @if($grenade->grenadeImages->count() > 0)
                <div id="carouselExampleControls{{$grenade->id}}" class="carousel slide" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach($grenade->grenadeImages as $key => $image)
                        <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                        <img src="{{ asset('storage/' . $image->path) }}" class="mx-auto d-block img-fluid" alt="{{ $grenade->describtion }}"
    style="max-width: 960px; height: 720px; quality: 90;">
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
        </div>
        @endforeach
    </div>
</div>
@endsection
