@extends('layouts.app')
@vite(['resources/js/grenadeVote.js'])
@vite(['resources/js/grenadeFavorite.js'])
{{-- MODAL GRENADE_GROUP --}}
@include('components.grenadeGroup')
<script src="{{ asset('js/grenadeGroup.js') }}" defer></script>
@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+10&display=swap" rel="stylesheet">
    <style>
        .grenade {
            background-color: black;
            border-radius: 5px;
        }

        .rounded {
            height: 330px;
            width: auto;
            transition: transform 0.3s ease-in-out;
        }

        @media (max-width: 575.98px) {
            .rounded {
                width: 100%;
                height: auto;
            }
        }

        .map-card {
            position: relative;
            overflow: hidden;
        }

        .map-name {
            font-family: "Anton", serif;
            font-weight: 400;
            font-style: normal;
            font-size: 2rem;
            text-shadow: 1px 1px 2px black;
            color: rgb(241, 237, 237);
            position: absolute;
            bottom: 40;
            left: 0;
            width: 100%;
            text-align: center;
            box-sizing: border-box;
            opacity: 1;
        }
            .map-grenades {
            font-family: "Anton", serif;
            font-weight: 400;
            font-style: normal;
            font-size: 1.5rem;
            text-shadow: 1px 1px 2px black;
            color: rgb(241, 237, 237);
            position: absolute;
            bottom: 10;
            left: 0;
            width: 100%;
            text-align: center;
            box-sizing: border-box;
            opacity: 1;
        }


        .map-card:hover {
            transform: scale(1.02);
            box-shadow: rgba(255, 254, 254, 0.05) 0px 6px 24px 0px;
            text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px  1px 0 black, 1px  1px 0 black
        }
        
        /* media queries */
        @media (min-width: 300px) {
            .custom-text {
                font-size: 12px;
            }
        }

        @media (min-width: 768px) {
            .custom-text {
                font-size: 16px;
            }
        }

        @media (min-width: 992px) {
            .custom-text {
                font-size: 20px;
            }
        }
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
                @foreach ($mapsActive as $map)
                    <div class="col-sm-auto m-1 p-0 map-card">
                        <a href="{{ route('maps.show', $map->id) }}">
                            @if (empty($map->image_path))
                                <img class="rounded" src="default" alt="error">
                            @else
                                <img class="rounded" src="{{ asset('storage/' . $map->image_path) }}"
                                    alt="{{ $map->description }}">
                            @endif
                            <div class="map-name">{{ $map->name }}</div>
                            <div class="map-grenades">{{ $map->grenades->count() }} nades</div>
                        </a>
                    </div>
                @endforeach
                <h1 class="my-3">Other maps:</h1>
                @foreach ($mapsOthers as $map)
                    <div class="col-md-auto m-1 p-0 map-card">
                        <a href="{{ route('maps.show', $map->id) }}">
                            @if (empty($map->image_path))
                                <img class="rounded" src="default" alt="error">
                            @else
                                <img class="rounded" src="{{ asset('storage/' . $map->image_path) }}"
                                    alt="{{ $map->description }}">
                            @endif
                            <div class="map-name">{{ $map->name }}</div>
                            <div class="map-grenades">{{ $map->grenades->count() }} nades</div>
                        </a>
                    </div>
                @endforeach
            </div>
            <h1>Recently added:</h1>
            <div class="row g-2 d-flex justify-content-center">
                @foreach ($grenades as $grenade)
                    <div class="grenade-card col-md-4">
                        <div class="d-flex justify-content-around">
                            <span class="text-md-center fs-6"
                                onclick="window.location.href = '{{ route('grenade.show', $grenade->id) }}';"
                                style="cursor:pointer">
                                <b>{{ $grenade->map->name }}</b>
                                {{ $grenade->areaTo->name }}
                                @if (isset($grenade->calloutTo->name))
                                    -> {{ $grenade->calloutTo->name }}
                                @endif
                                <b>{{ $grenade->type }}</b>
                            </span>
                     <div class="display-flex justify-content-end">
                                {{-- GRENADE EDIT BTN --}}
                                @if(Auth::check() && Auth::user()->id === $grenade->user->id)
                                <a class="btn" href="{{ route('grenade.edit', $grenade->id)}}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                {{-- GRENADE DELETE BTN --}}                               
                                <form action="{{ route('grenade.destroy', $grenade->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')            
                                    <button class="btn btn-link" title="{{ __('cs2.buttons.delete') }}" onclick="return confirm('Czy na pewno chcesz usunąć ten element?')">
                                        <i class="fa-regular fa-circle-xmark" style="color: #d31717;"></i>
                                    </button>
                                </form>
                                @endif
                                {{-- GRENADE GROUP BTN --}}
                                <button class="btn btn-link" onclick="showCustomModal({{ $grenade->id }}, {{ $grenade->map->id }});">
                                    <i class="fa-solid fa-layer-group"></i>
                                </button>
                            </div>
                        </div>
                        <div class="m-1">
                            @if ($grenade->source_type === 'youtube_path')
                                <div class="grenade ">
                                    <iframe class="mx-auto d-block img-fluid"
                                        style="border-radius:5px;width: 100%; height: 80%" alt=""
                                        width="" height=""
                                        src="https://www.youtube.com/embed/{{ $grenade->youtube_path }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                            @elseif($grenade->source_type === 'images')

                            <div class="grenade text-center">
                                {{-- Sprawdź czy istnieje obrazek typu multiple --}}
                                @if($grenade->grenadeImages->contains('type', 'multiple'))
                                    @foreach ($grenade->grenadeImages as $image)
                                        @if($image->type === 'multiple')
                                            <img 
                                                src="{{ asset('storage/' . $image->path) }}" 
                                                alt="multiple" 
                                                class="img-fluid"
                                                style="max-height: 300px; object-fit: contain;">
                                            @break
                                        @endif
                                    @endforeach

                                {{-- Jeśli są oba: throwing i landing --}}
                                @elseif(
                                    $grenade->grenadeImages->contains('type', 'throwing') &&
                                    $grenade->grenadeImages->contains('type', 'landing')
                                )
                                    <img-comparison-slider class="w-100" style="max-width: 100%; max-height: 300px; display: inline-block;">
                                        @foreach ($grenade->grenadeImages as $image)
                                            @if($image->type === 'throwing')
                                                <img 
                                                    slot="first" 
                                                    src="{{ asset('storage/' . $image->path) }}" 
                                                    alt="throwing" 
                                                    class="img-fluid"
                                                    style="max-height: 300px; object-fit: contain;">
                                            @elseif($image->type === 'landing')
                                                <img 
                                                    slot="second" 
                                                    src="{{ asset('storage/' . $image->path) }}" 
                                                    alt="landing" 
                                                    class="img-fluid"
                                                    style="max-height: 300px; object-fit: contain;">
                                            @endif
                                        @endforeach
                                    </img-comparison-slider>

                                {{-- Jeśli jest tylko throwing --}}
                                @elseif($grenade->grenadeImages->contains('type', 'throwing'))
                                    @foreach ($grenade->grenadeImages as $image)
                                        @if($image->type === 'throwing')
                                            <img 
                                                src="{{ asset('storage/' . $image->path) }}" 
                                                alt="throwing" 
                                                class="img-fluid"
                                                style="max-height: 300px; object-fit: contain;">
                                            @break
                                        @endif
                                    @endforeach

                                {{-- Jeśli jest tylko landing --}}
                                @elseif($grenade->grenadeImages->contains('type', 'landing'))
                                    @foreach ($grenade->grenadeImages as $image)
                                        @if($image->type === 'landing')
                                            <img 
                                                src="{{ asset('storage/' . $image->path) }}" 
                                                alt="landing" 
                                                class="img-fluid"
                                                style="max-height: 300px; object-fit: contain;">
                                            @break
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            @endif
                        </div>
                        <div style="align-items: center" class="my-1 d-flex flex-row justify-content-between px-3">
                            {{-- VOTE --}}
                            <div class="like-grenade-footer">
                                <button class="btn btn-link vote-btn" data-vote-id="{{ $grenade->id }}" data-type="-1">
                                    <i class="fa-solid fa-minus fa-sm" style="color: #f00000"></i>
                                </button>
                                <span class="fs-6"
                                    id="vote_result_{{ $grenade->id }}">{{ $grenade->vote_result }}</span>
                                <button class="btn btn-link vote-btn" data-vote-id="{{ $grenade->id }}" data-type="1">
                                    <i class="fa-solid fa-plus fa-sm" style="color: #00f068"></i>
                                </button>
                            </div>
                            {{-- FAVORITE --}}
                            <div class="favorite-grenade-footer">
                                <button class="btn btn-link favorite-btn" data-favorite-id="{{ $grenade->id }}"
                                    @if ($grenade->favorite === 0) title="{{ __('cs2.btn.title.favorite.add') }}" @else title="{{ __('cs2.btn.title.favorite.delete') }}" @endif>
                                    <i style="color:gold"
                                        class="fs-6 @if ($grenade->favorite === 0) fa-regular @else fa-solid @endif fa-star fa-lg"></i>
                                </button>
                                {{-- <span class="fs-5" id=""></span> --}}
                            </div>
                            <div class="author-grenade-footer">
                                <span class="text-end">Added by: <b><a style="color: #f00000; text-decoration: none"
                                            href="{{ route('users.show', $grenade->user->id) }}">{{ $grenade->user->name }}</a></b></span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
<script>

</script>
    @endsection

