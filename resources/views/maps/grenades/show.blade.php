@extends('layouts.app')
@vite(['resources/js/mapPageFiltersShow.js'])
@vite(['resources/js/grenadeVote.js'])
@vite(['resources/js/grenadeFavorite.js'])
@section('content')
    <div class="card my-2">
        <div class="card my-2 ps-3 border border-0">
            <span class="text-md-center fs-4">
                <b>{{ $grenade->type }}</b>
                <b>from: </b>{{ $grenade->areaFrom->name }}
                @if (isset($grenade->calloutFrom->name))
                    -> {{ $grenade->calloutFrom->name }}
                @endif
                <b> to:</b> {{ $grenade->areaTo->name }}
                @if (isset($grenade->calloutTo->name))
                    -> {{ $grenade->calloutTo->name }}
                @endif
            </span>
        </div>
        @if($grenade->source_type === 'youtube_path')
        <div id="yt" class="d-flex justify-content-center align-items-center">
            <iframe width="1440" height="810" src="https://www.youtube.com/embed/{{ $grenade->youtube_path }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
        @elseif($grenade->source_type === 'images')
        @if ($grenade->grenadeImages->count() > 0)
            <div id="carouselExampleControls{{ $grenade->id }}" class="carousel slide position-relative"
                data-bs-interval="false">
                <div class="carousel-inner">
                    @foreach ($grenade->grenadeImages as $key => $image)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->path) }}" class="mx-auto d-block img-fluid"
                                alt="{{ $grenade->description }}" style="max-width: 1440px; height: 810px; quality: 90;"
                                data-action="zoom">
                            <div class="carousel-caption">
                                <span class="carousel-slide-number fs-1 fw-bolder">{{ $loop->iteration }}</span>
                                <span class="fw-bold fs-1 fw-bolder">/</span>
                                <span
                                    class="carousel-total-slides fs-1 fw-bolder">{{ count($grenade->grenadeImages) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselExampleControls{{ $grenade->id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselExampleControls{{ $grenade->id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @endif
        @endif
        <div style="align-items: center" class="card my-2 border border-0 d-flex flex-row justify-content-evenly">
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
                <button class="btn btn-link favorite-btn" data-favorite-id="{{ $grenade->id }}" @if($grenade->favorite === 0) title="{{__('cs2.btn.title.favorite.add')}}" @else title="{{__('cs2.btn.title.favorite.delete')}}" @endif>
                    <i style="color:gold" class="fs-6 @if($grenade->favorite === 0) fa-regular @else fa-solid @endif fa-star fa-xl"></i>
                </button>
                {{-- <span class="fs-5" id=""></span> --}}
            </div>
            {{-- VISIBILITY --}}
            @can('isAdmin')
                <div class="visibility">
                    @if ($grenade->visibility === 1)
                        public
                    @else
                        private
                    @endif
                </div>
            @endcan
            <div class="author-grenade-footer">
                <span class="text-end">Added by: <b><a style="color: #f00000; text-decoration: none"
                            href="{{ route('users.show', $grenade->user->id) }}">{{ $grenade->user->name }}</a></b></span>
            </div>
        </div>
    </div>
@endsection
