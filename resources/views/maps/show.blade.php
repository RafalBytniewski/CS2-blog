@extends('layouts.app')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
@section('content')
@vite(['resources/js/welcome.js'])
@vite('resources/js/'.$maps->name.'.js')
<style>
    .show-more {
    display: block;
    margin-top: 10px;
    }
    .kontejner{
        display:flex;
        justify-content: center;
    }
    #map-container {
            height: 750px;
            width: 750px;
            margin-bottom: 50px;
            position: relative;

        }

        #map {
            height: 100%;
            width: 100%;
            background-color: grey;
            /* Tło strony */
            border: 1px solid black;
        }

        .leaflet-container {
            height: 100%;
            width: 100%;
        }
</style>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container">

    <div class="card-header d-flex flex-column">
        <div class=" d-flex justify-content-end">
            @can('isAdmin')
                <a href="{{ route('maps.settings', $maps->id) }}">
                    <button class="btn btn-lg btn-outline-primary my-2">
                        {{ __('cs2.buttons.settings')}}
                    </button>
                </a>
            @endcan
            @auth
                <a href="{{ route('grenade.create', $maps->id) }}">
                    <button class="btn btn-lg btn-outline-primary my-2">
                        {{ __('cs2.buttons.add_grenade')}}
                    </button>
                </a>
            @endauth
        </div>
        <span class="fw-bold my-4" style="text-align:center;font-size: 60px">{{$maps->name}}</span>
        <div class="kontejner">
        <div id="map-container">
            <div id="map"></div>
        </div>
    </div>
    </div>
    <div class="card-body">
        <form action="" method="get">
            @csrf
            <div class="card d-flex flex-row justify-content-center align-items-start border-0" id="filter">
                <div class="filter-category mx-4">
                    <div class="card-header">
                        <span class="title fs-4">{{ __('cs2.map.show.agent')}}</span>
                    </div>
                    <div class="card-body">
                        <label class="form-check" for="Terrorist">
                            <input name="team" class="form-check-input" type="checkbox" value="Terrorist" id="Terrorist">
                            <span class="form-check-label">
                                Terrorist
                            </span>
                        </label>
                        <label class="form-check" for="Counter-Terrorist">
                            <input class="form-check-input" name="team" type="checkbox" value="Counter-Terrorist" id="Counter-Terrorist">
                            <span class="form-check-label">
                                Counter-Terrorist
                            </span>
                        </label>
                    </div>
                </div>         
                <div class="filter-category mx-4">
                    <header class="card-header">
                        <span class="title fs-4">{{ __('cs2.map.show.nade_type')}}</span>
                    </header>
                    <div class="card-body">
                        @foreach($types as $type)
                            <label class="form-check" for="type-{{$type}}">
                                <input class="form-check-input" name="type" type="checkbox" value="{{$type}}" id="type-{{$type}}">
                                <span class="form-check-label">
                                    {{$type}}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>  
                <div class="filter-category mx-4">
                    <header class="card-header">
                        <span class="title fs-4" style="text-align:center;">{{ __('cs2.map.show.from') }}</span>
                    </header>
                    <div class="d-flex">
                        <div class="card-body flex-fill">
                            @foreach($areas as $area)
                                <label class="form-check" for="area-from-{{ $area->id }}">
                                    <input class="form-check-input areaFromSelect" name="areaFrom" type="checkbox" value="{{ $area->id }}" id="area-{{ $area->id }}">
                                    <span class="form-check-label">
                                        {{ $area->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        <div class="filter-content flex-fill d-none" id="calloutsFromSection">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-category mx-4">
                    <header class="card-header">
                        <span class="title fs-4" style="text-align:center;">{{ __('cs2.map.show.to')}}</span>
                    </header>
                    <div class="d-flex">
                        <div class="card-body flex-fill">
                            @foreach($areas as $area)
                                <label class="form-check" for="area-to-{{ $area->id }}">
                                    <input class="form-check-input areaToSelect" type="checkbox" name="areaTo" value="{{ $area->id }}" id="area-to-{{ $area->id }}">
                                    <span class="form-check-label">
                                        {{ $area->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        <div class="filter-content flex-fill d-none" id="calloutsToSection">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit">send</button>
            </div> 
        </form>
        <div class="container col-10 d-flex justify-content-end">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    View:
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">5</a></li>
                    <li><a class="dropdown-item" href="#">10</a></li>
                    <li><a class="dropdown-item" href="#">20</a></li>
                </ul>
            </div>  
        </div>
        <div class="container col-10">
            @foreach($grenades as $grenade)
            <div class="card my-2">
                <div class="card my-2 ps-3 border border-0">
                    <span class="text-md-center fs-4">
                        <b>{{ $grenade->type }}</b>
                        <b>from: </b>{{ $grenade->areaFrom->name}} 
                        @if(isset($grenade->calloutFrom->name))
                            -> {{ $grenade->calloutFrom->name }}
                        @endif       
                        <b> to:</b> {{ $grenade->areaTo->name}} 
                        @if(isset($grenade->calloutTo->name))
                            -> {{ $grenade->calloutTo->name }}
                        @endif
                    </span>
                </div>
                @if($grenade->grenadeImages->count() > 0)
                    <div id="carouselExampleControls{{$grenade->id}}" class="carousel slide position-relative" data-bs-interval="false">
                        <div class="carousel-inner">
                            @foreach($grenade->grenadeImages as $key => $image)
                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="mx-auto d-block img-fluid" alt="{{ $grenade->describtion }}" style="max-width: 960px; height: 720px; quality: 90;" data-action="zoom">
                                    <div class="carousel-caption">
                                        <span class="carousel-slide-number fs-1 fw-bolder">{{$loop->iteration}}</span>
                                        <span class="fw-bold fs-1 fw-bolder">/</span>
                                        <span class="carousel-total-slides fs-1 fw-bolder">{{ count($grenade->grenadeImages) }}</span>
                                    </div>
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
                <div class="card my-2 border border-0 d-flex flex-row justify-content-evenly">
                    <div class="like-grenade-footer">
                        <form action="{{ route('vote', ['grenadeId' => $grenade->id]) }}" method="post">
                            @csrf
                        
                            <button class="btn btn-link" type="submit" name="vote_type" value="-1">
                                <i class="fa-solid fa-minus fa-xl" style="color: #f00000"></i>
                            </button>
                            <span class="fs-5">
                                @php
                                    $voteSum = $grenade->votes()->sum('vote_type');
                                    echo $voteSum;
                                @endphp
                            </span>
                            <button class="btn btn-link" type="submit" name="vote_type" value="1">
                                <i class="fa-solid fa-plus fa-xl" style="color: #00f068"></i>
                            </button>
                        </form>
                    </div>
                    <div class="favorite-grenade-footer">
                        <a href=""><i class="fa-regular fa-star fa-lg"></i></a>
                        <span class="fs-5">0</span>
                    </div>
                    @can('isAdmin')
                        <div class="visibility">
                            @if($grenade->visibility === 1)
                                public
                            @else
                                private
                            @endif
                        </div>
                    @endcan
                    <div class="author-grenade-footer">
                        <span class="text-end">Added by: <b style="color: #f00000">{{$grenade->user->name}}</b></span>
                    </div>
                </div>        
            </div>
            @endforeach
        </div>
    </div>
</div> 
@endsection
