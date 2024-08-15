@extends('layouts.app')
@section('content')
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
                        <img src="{{ asset('storage/' . $image->path) }}" class="mx-auto d-block img-fluid" alt="{{ $grenade->describtion }}" style="max-width: 1440px; height: 810px; quality: 90;" data-action="zoom">
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
@endsection