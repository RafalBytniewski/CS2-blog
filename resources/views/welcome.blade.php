@extends('layouts.app')
@vite(['resources/js/grenadeVote.js'])
@vite(['resources/js/grenadeFavorite.js'])

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+10&display=swap" rel="stylesheet">
    <style>
        .grenade {
            background-color: black;
            height: 153px;
            width: 272px;
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

        .map-card:hover {
            transform: scale(1.02);
            box-shadow: rgba(255, 254, 254, 0.05) 0px 6px 24px 0px;
        }

        .grenade-card:hover {
            transform: scale(1.02);
        }

        .map-card:hover .map-name {
            opacity: 1;
        }

        /* Przykładowe media queries */
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
                        </a>
                    </div>
                @endforeach
            </div>
            <h1>Recently added:</h1>
            <div class="row g-2 d-flex justify-content-center">
                @foreach ($grenades as $grenade)
                    <div class="grenade-card col-md-3">
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
                        <div class="m-1">
                            @if ($grenade->source_type === 'youtube_path')
                                <div class="grenade d-flex justify-content-center align-items-center">
                                    <iframe class="mx-auto d-block img-fluid"
                                        style="border-radius:5px;width: auto; max-height: 153px" alt=""
                                        width="" height=""
                                        src="https://www.youtube.com/embed/{{ $grenade->youtube_path }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                            @elseif($grenade->source_type === 'images')
                                @if ($grenade->grenadeImages->count() > 0)
                                    <div id="carouselExampleControls{{ $grenade->id }}"
                                        class="carousel slide position-relative" data-bs-interval="false">
                                        <div class="carousel-inner">
                                            @foreach ($grenade->grenadeImages as $key => $image)
                                                <div class="grenade carousel-item {{ $loop->first ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $image->path) }}"
                                                        class="mx-auto d-block img-fluid" alt=""
                                                        style="border-radius:5px;width: auto; max-height: 153px; quality: 90;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleControls{{ $grenade->id }}"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleControls{{ $grenade->id }}"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                @endif
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
                                <button class="btn btn-link favorite-btn" data-favorite-id="{{ $grenade->id }}" @if($grenade->favorite === 0) title="{{__('cs2.btn.title.favorite.add')}}" @else title="{{__('cs2.btn.title.favorite.delete')}}" @endif>
                                    <i style="color:gold" class="fs-6 @if($grenade->favorite === 0) fa-regular @else fa-solid @endif fa-star fa-lg"></i>
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

    @endsection
