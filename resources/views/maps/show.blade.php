@extends('layouts.app')
@vite(['resources/js/mapPageFiltersShow.js'])
@vite(['resources/js/grenadeVote.js'])
@vite(['resources/js/grenadeFavorite.js'])
@section('content')
@php
$mapFileName = strtolower($maps->name) . '.js';
$mapFilePath = resource_path('js/map/' . $mapFileName);
@endphp
@if(file_exists(resource_path('js/map/' . $mapFileName)))
@vite('resources/js/' . $mapFileName)
@endif


<style>
    .show-more {
        display: block;
        margin-top: 10px;
    }

    #main-map {
        display: flex;
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
        border-radius: 5px;
    }

    .leaflet-container {
        height: 100%;
        width: 100%;
    }
</style>
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
        <span class="fw-bold my-4" id="map_title" style="text-align:center;font-size: 60px">{{$maps->name}}</span>
        {{-- LEAFLET MAP PLAN --}}
        @if(file_exists($mapFilePath))
        @vite('resources/js/map/' . $mapFileName)
        <div id="main-map">
            <div class="card" id="map-container">
                <div id="map"></div>
            </div>
        </div>
        @endif
    </div>
    <div class="card-body">
        <div class="container">
            <div class="card container switch_btns col-10 d-flex justify-content-center flex-row">
                <button class="btn btn-primary flex-fill switch_btn" id="grenade_btn">Grenades</button>
                <button class="btn btn-outline-primary flex-fill switch_btn" id="group_btn">Groups</button>
            </div>
            <div id="group_container" style="display:none">
                <div class="container col-10">
                    @foreach($groups as $group)
                    <div style="border:1px solid red" class="card my-2">
                        <div class="card my-2 ps-3 border border-0">
                            title
                        </div>
                        <div style="align-items: center"
                            class="card my-2 border border-0 d-flex flex-row justify-content-evenly">
                            <div class="container d-flex">
                                <div class="row row-cols-2 g-4"> {{-- 2 kolumny, odstęp g-4 --}}
                                    @foreach ($group->grenades->take(4) as $grenade)
                                    <div class="col d-flex justify-content-center">
                                        @php
                                        $landingImage = $grenade->grenadeImages->firstWhere('type', 'landing');
                                        @endphp

                                        @if ($landingImage)
                                        <img src="{{ asset('storage/' . $landingImage->path) }}"
                                            class="img-fluid rounded shadow"
                                            style="max-width: 100%; height: 300px; object-fit: cover;"
                                            alt="landing image">
                                        @else
                                        <span>No landing image</span>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="author-grenade-footer">
                            <span class="text-end">Added by: <b><a style="color: #f00000; text-decoration: none"
                                        href=""></a></b></span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div id="grenade_container">
                {{-- filter section start --}}
                <form action="{{ route('maps.show', $maps->id) }}" method="get">
                    @csrf
                    <div class="container card p-2 col-10">
                        <div class="card d-flex flex-row justify-content-center align-items-start border-0" id="filter">
                            {{-- team --}}
                            <div class="filter-category mx-4">
                                <div class="card-header">
                                    <span class="title fs-4">{{ __('cs2.map.show.agent') }}</span>
                                </div>
                                <div class="card-body">
                                    <label class="form-check" for="Terrorist">
                                        <input name="team[]" class="form-check-input" type="checkbox" value="Terrorist"
                                            id="Terrorist">
                                        <span class="form-check-label">Terrorist</span>
                                    </label>
                                    <label class="form-check" for="Counter-Terrorist">
                                        <input class="form-check-input" name="team[]" type="checkbox"
                                            value="Counter-Terrorist" id="Counter-Terrorist">
                                        <span class="form-check-label">Counter-Terrorist</span>
                                    </label>
                                </div>
                            </div>
                            {{-- type --}}
                            <div class="filter-category mx-4">
                                <header class="card-header">
                                    <span class="title fs-4">{{ __('cs2.map.show.nade_type') }}</span>
                                </header>
                                <div class="card-body">
                                    @foreach($types as $type)
                                    <label class="form-check" for="type-{{$type}}">
                                        <input class="form-check-input" name="type[]" type="checkbox" value="{{$type}}"
                                            id="type-{{$type}}">
                                        <span class="form-check-label">{{ $type }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            {{-- area/callout from --}}
                            <div class="filter-category mx-4">
                                <header class="card-header">
                                    <span class="title fs-4" style="text-align:center;">{{ __('cs2.map.show.from')
                                        }}</span>
                                </header>
                                <div class="d-flex">
                                    <div class="card-body flex-fill">
                                        @foreach($areas as $area)
                                        <label class="form-check" for="area-from-{{ $area->id }}">
                                            <input class="form-check-input areaFromSelect" name="area_from_id[]"
                                                type="checkbox" value="{{ $area->id }}" id="area-from-{{ $area->id }}">
                                            <span class="form-check-label">{{ $area->name }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                    <div class="filter-content flex-fill d-none" id="calloutsFromSection">
                                        <div class="card-body">
                                            <!-- callouts_from -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- area/callout to --}}
                            <div class="filter-category mx-4">
                                <header class="card-header">
                                    <span class="title fs-4" style="text-align:center;">{{ __('cs2.map.show.to')
                                        }}</span>
                                </header>
                                <div class="d-flex">
                                    <div class="card-body flex-fill">
                                        @foreach($areas as $area)
                                        <label class="form-check" for="area-to-{{ $area->id }}">
                                            <input class="form-check-input areaToSelect" type="checkbox"
                                                name="area_to_id[]" value="{{ $area->id }}"
                                                id="area-to-{{ $area->id }}">
                                            <span class="form-check-label">{{ $area->name }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                    <div class="filter-content flex-fill d-none" id="calloutsToSection">
                                        <div class="card-body">
                                            <!-- callouts_to -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="subit" class="btn btn-primary" id="filterButton">FILTER</button>
                    </div>
                </form>
                {{-- filter section end --}}

                <div
                    class="card display-flex flex-row container col-10 d-flex justify-content-evenly align-items-center">
                    <div class="resultInfo fs-4">There
                        @if($count === 0)
                        is no results
                        @elseif($count === 1)
                        is <b>{{ $count}}</b> result for your searching
                        @else
                        are <b>{{ $count }}</b> results for your searching
                        @endif
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
                            <span class="text-md-center fs-4"
                                onclick="window.location.href = '{{ route('grenade.show', $grenade->id) }}';"
                                style="cursor:pointer">
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
                        @if($grenade->source_type === 'youtube_path')
                        <div id="yt" class="d-flex justify-content-center align-items-center">
                            <iframe width="960" height="540"
                                src="https://www.youtube.com/embed/{{ $grenade->youtube_path }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        @elseif($grenade->source_type === 'images')
                        {{-- DISPLAY IMAGES --}}
                        @if($grenade->grenadeImages->count() > 0)
                        <div id="carouselExampleControls{{$grenade->id}}" class="carousel slide position-relative"
                            data-bs-interval="false">
                            <div class="carousel-inner">
                                @foreach($grenade->grenadeImages as $key => $image)
                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="mx-auto d-block img-fluid"
                                        alt="{{ $grenade->description }}"
                                        style="max-width: 960px; height: 504; quality: 90;" data-action="zoom">
                                    <div class="carousel-caption">
                                        <span class="carousel-slide-number fs-1 fw-bolder">{{$loop->iteration}}</span>
                                        <span class="fw-bold fs-1 fw-bolder">/</span>
                                        <span class="carousel-total-slides fs-1 fw-bolder">{{
                                            count($grenade->grenadeImages)
                                            }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleControls{{$grenade->id}}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleControls{{$grenade->id}}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        @endif
                        @endif
                        <div style="align-items: center"
                            class="card my-2 border border-0 d-flex flex-row justify-content-evenly">
                            {{-- VOTE --}}
                            <div class="like-grenade-footer">
                                <button class="btn btn-link vote-btn" data-vote-id="{{$grenade->id}}" data-type="-1">
                                    <i class="fa-solid fa-minus fa-xl" style="color: #f00000"></i>
                                </button>
                                <span class="fs-5" id="vote_result_{{$grenade->id}}">{{ $grenade->vote_result }}</span>
                                <button class="btn btn-link vote-btn" data-vote-id="{{$grenade->id}}" data-type="1">
                                    <i class="fa-solid fa-plus fa-xl" style="color: #00f068"></i>
                                </button>
                            </div>
                            {{-- FAVORITE --}}
                            <div class="favorite-grenade-footer">
                                <button class="btn btn-link favorite-btn" data-favorite-id="{{ $grenade->id }}"
                                    @if($grenade->favorite === 0) title="{{__('cs2.btn.title.favorite.add')}}" @else
                                    title="{{__('cs2.btn.title.favorite.delete')}}" @endif>
                                    <i style="color:gold"
                                        class="fs-6 @if($grenade->favorite === 0) fa-regular @else fa-solid @endif fa-star fa-xl"></i>
                                </button>
                                {{-- <span class="fs-5" id=""></span> --}}
                            </div>
                            {{-- VISIBILITY --}}
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
                                <span class="text-end">Added by: <b><a style="color: #f00000; text-decoration: none"
                                            href="{{route('users.show', $grenade->user->id)}}">{{$grenade->user->name}}</a></b></span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const grenade_btn = document.querySelector('#grenade_btn')
    const group_btn = document.querySelector('#group_btn')
    const grenade_container = document.querySelector('#grenade_container')
    const group_container = document.querySelector('#group_container')
    const switch_btn = document.querySelectorAll('.switch_btn')
    const map_title = document.querySelector('#map_title')

    grenade_btn.addEventListener('click', function(){
        group_container.style.display = 'none';    
        grenade_container.style.display = ''; 
        grenade_btn.classList.add('btn-primary');
        grenade_btn.classList.remove('btn-outline-primary');
        group_btn.classList.remove('btn-primary');
        group_btn.classList.add('btn-outline-primary'); 
        map_title.innerHTML = '{{$maps->name}} - grenades'
    })

    group_btn.addEventListener('click', function(){
        grenade_container.style.display = 'none'; 
        group_container.style.display = '';
        group_btn.classList.add('btn-primary');
        group_btn.classList.remove('btn-outline-primary');
        grenade_btn.classList.remove('btn-primary');
        grenade_btn.classList.add('btn-outline-primary');  
        map_title.innerHTML = '{{$maps->name}} - groups'     
    })

</script>
@endsection