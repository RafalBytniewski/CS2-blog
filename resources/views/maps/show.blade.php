@extends('layouts.app')

@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    .show-more {
    display: block;
    margin-top: 10px; /* Dostosuj margines według potrzeb */
}
</style>
<div class="container">
    <div class="card-header d-flex flex-column">
        <div class=" d-flex justify-content-end">
            <a href="{{ route('maps.settings', $maps->id) }}">
                <button class="btn btn-lg btn-outline-primary my-2">
                    {{ __('cs2.map.show.settings')}}
                </button>
            </a>
            <a href="{{ route('maps.create', $maps->id) }}">
                <button class="btn btn-lg btn-outline-primary my-2">
                    {{ __('cs2.map.show.add_grenade')}}
                </button>
            </a>
        </div>
        <h1 class="fs-1 fw-bold my-4" style="text-align:center">{{$maps->name}}</h1>

    </div>
    <div class="card-body">
        <div class="card d-flex flex-row justify-content-center align-items-start border-0">
            <article class="card-group-item mx-4">
                <header class="card-header">
                    <h6 class="title fs-4">{{ __('cs2.map.show.agent')}}</h6>
                </header>
                <div class="filter-content">
                    <div class="card-body">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                                <span class="form-check-label">
                                    Terrorist
                                </span>
                            </label>
                                <label class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                                <span class="form-check-label">
                                    Counter-Terrorist
                                </span>
                            </label>
                    </div>
                </div>
            </article>         
            <article class="card-group-item mx-4">
                <header class="card-header">
                    <h6 class="title fs-4">{{ __('cs2.map.show.nade_type')}}</h6>
                </header>
                <div class="filter-content">
                    <div class="card-body">
                        @foreach($types as $type)
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="{{$type}}">
                                <span class="form-check-label">
                                    {{$type}}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </article>  
            <article class="card-group-item mx-4">
                <header class="card-header">
                    <h6 class="title fs-4" style="text-align:center;">{{ __('cs2.map.show.from') }}</h6>
                </header>
                <div class="d-flex">
                    <div class="filter-content flex-fill">
                        <div class="card-body">
                            @foreach($areas as $area)
                                <label class="form-check">
                                    <input class="form-check-input areaFromSelect" type="checkbox" value="{{ $area->id }}">
                                    <span class="form-check-label">
                                        {{ $area->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="filter-content flex-fill d-none" id="calloutsFromSection">
                        <div class="card-body">
                            <!-- Tutaj będą wyświetlane wywołania dla wybranych obszarów -->
                        </div>
                    </div>
                </div>
            </article>
            <article class="card-group-item mx-4">
                <header class="card-header">
                    <h6 class="title fs-4" style="text-align:center;">{{ __('cs2.map.show.to')}}</h6>
                </header>
                <div class="d-flex">
                    <div class="filter-content flex-fill">
                        <div class="card-body">
                            @foreach($areas as $area)
                                <label class="form-check">
                                    <input class="form-check-input areaToSelect" type="checkbox" value="{{ $area->id }}">
                                    <span class="form-check-label">
                                        {{ $area->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="filter-content flex-fill d-none" id="calloutsToSection">
                        <div class="card-body">
                            <!-- Tutaj będą wyświetlane wywołania dla wybranych obszarów -->
                        </div>
                    </div>
                </div>
            </article>
            
        </div> 
    
        

        @foreach($grenades as $grenade)
        <div class="card border border-primary my-2">
            <div class="card my-2 ps-3 border border-0">
                <span class="text-md-start fs-4">
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
            <div class="card my-2 pe-3 border border-0">
                <span class="text-end">Added by: <b style="color:red">{{$grenade->user->name}}</b></span>
            </div>        
        </div>
        @endforeach
    </div>
</div>
@endsection


@section('js')
    @vite(['resources/js/welcome.js'])
@endsection