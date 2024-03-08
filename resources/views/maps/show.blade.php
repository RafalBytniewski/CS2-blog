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
            <span>Callout from: {{ $grenade->calloutFrom->name }}</span>
            <span>Callout to: {{ $grenade->calloutTo->name }}</span>
            @if($grenade->grenadeImages->count() > 0)
            <div id="carouselExampleControls{{$grenade->id}}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($grenade->grenadeImages as $key => $image)
                    <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                        <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="..."
                             style="max-width: 540px; height: 960;">
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
