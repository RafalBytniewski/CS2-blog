@extends('layouts/app')

@section('content')
@vite(['resources/js/createGrenade.js'])
@vite(['resources/js/mapPageFiltersShow.js'])
@php
    $mapFileName = lcfirst($map->name) . '.js';
    $mapFilePath = resource_path('js/' . $mapFileName);
@endphp
@if(file_exists(resource_path('js/' . $mapFileName)))
    @vite('resources/js/' . $mapFileName)
@endif
<style>
    .show-more {
        display: block;
        margin-top: 10px;
    }
    #main-map{
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
        border-radius: 5px;
    }
    .leaflet-container {
        height: 100%;
        width: 100%;
    }
</style>
    <div class="container">
        <div class="card-header">
            <h1 style="text-align:center">{{__("cs2.map.grenade.form.create_title")}}</h1>
        </div>
        @if(file_exists($mapFilePath))
        @vite('resources/js/' . $mapFileName)
        <div id="main-map">
            <div class="card" id="map-container">
                <div id="map"></div>
            </div>
        </div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('grenade.store', $map->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="map" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.map') }}</label>
                    <div class="col-md-6">
                        <input id="map" name="map_id" type="hidden" value="{{ $map->id }}">
                        <input id="map_name" name="map_name" type="text" value="{{ $map->name }}" readonly class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="team" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.team') }}</label>
                    <div class="col-md-6">
                        <select id="team" name="team" class="form-control @error('team') is-invalid @enderror" required>
                            <option value=""></option>
                            <option value="Terrorist">Terrorist</option>
                            <option value="Counter-Terrorist">Counter-Terrorist</option>
                        </select>
                        @error('team')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.type') }}</label>
                    <div class="col-md-6">
                        <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required>
                            <option value=""></option>
                            <option value="Smoke">Smoke</option>
                            <option value="Flash">Flash</option>
                            <option value="He Grenade">He Grenade</option>
                            <option value="Molotov">Molotov</option>

                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="visibility" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.visibility') }}</label>
                    <div class="col-md-6">
                        <select id="visibility" name="visibility" class="form-control @error('visibility') is-invalid @enderror" required>
                            <option value=""></option>
                            <option value="0">{{ __('cs2.map.grenade.form.private') }}</option>
                            <option value="1" selected>{{ __('cs2.map.grenade.form.public') }}</option>
                        </select>
                        @error('visibility')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="area_from" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.throwing_from_(area)') }}</label>
                    <div class="col-md-6">
                        <select id="area_from" name="area_from_id" class="form-control @error('area') is-invalid @enderror" required>
                            <option value=""></option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div hidden class="row mb-3" id="callout_from_div" >
                    <label for="callout_from" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.optional') }}</label>
                    <div class="col-md-6">
                        <select id="callout_from" name="callout_from_id" class="form-control @error('callout_from') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($callouts as $callout)
                                <option value="{{ $callout->id }}">{{ $callout->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="area_to" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.throwing_to_(area)') }}</label>
                    <div class="col-md-6">
                        <select id="area_to" name="area_to_id" class="form-control @error('area') is-invalid @enderror" required>
                            <option value=""></option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div hidden class="row mb-3" id="callout_to_div">
                    <label for="callout_to" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.optional') }}</label>
                    <div class="col-md-6">
                        <select id="callout_to" name="callout_to_id" class="form-control @error('callout_to') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($callouts as $callout)
                                <option value="{{ $callout->id }}">{{ $callout->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="describtion" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.describtion') }}</label>
                    <div class="col-md-6">
                        <textarea placeholder="Max. 500 char"id="describtion" name="describtion" class="form-control @error('describtion') is-invalid @enderror" maxlength="500" autocomplete="describtion" autofocus></textarea>
                        @error('describtion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.images') }}</label>
                    <div class="col-md-6">
                        <input id="images" name="images[]" type="file" multiple class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" autofocus >
                        @error('images')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('images.*')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('cs2.map.grenade.form.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection