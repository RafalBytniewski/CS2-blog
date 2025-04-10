@extends('layouts/app')

@section('content')
@vite(['resources/js/createGrenade.js'])
@vite(['resources/js/mapPageFiltersShow.js'])
@php
$mapFileName = lcfirst($map->name) . '.js';
$mapFilePath = resource_path('js/' . $mapFileName);
@endphp
@if (file_exists(resource_path('js/' . $mapFileName)))
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
    <div class="card-header">
        <h1 style="text-align:center">{{ __('cs2.map.grenade.form.create_title') }}</h1>
    </div>
    @if (file_exists($mapFilePath))
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
            {{-- MAP --}}
            <div class="row mb-3">
                <label for="map" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.map')
                    }}</label>
                <div class="col-md-6">
                    <input id="map" name="map_id" type="hidden" value="{{ $map->id }}">
                    <input id="map_name" name="map_name" type="text" value="{{ $map->name }}" readonly
                        class="form-control">
                </div>
            </div>
            {{-- TEAM --}}
            <div class="row mb-3">
                <label for="team" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.team')
                    }}</label>
                <div class="col-md-6">
                    <select id="team" name="team" class="form-control @error('team') is-invalid @enderror" required
                        autofocus>
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
            {{-- TYPE --}}
            <div class="row mb-3">
                <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.type')
                    }}</label>
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
            {{-- VISIBILITY --}}
            <div class="row mb-3">
                <label for="visibility" class="col-md-4 col-form-label text-md-end">{{
                    __('cs2.map.grenade.form.visibility') }}</label>
                <div class="col-md-6">
                    <select id="visibility" name="visibility"
                        class="form-control @error('visibility') is-invalid @enderror" required>
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
            {{-- AREA CALLOUT FROM --}}
            <div class="row mb-3">
                <label for="area_from" class="col-md-4 col-form-label text-md-end">{{
                    __('cs2.map.grenade.form.throwing_from_(area)') }}</label>
                <div class="col-md-6">
                    <select id="area_from" name="area_from_id"
                        class="form-control @error('area_from_id') is-invalid @enderror" required>
                        <option value=""></option>
                        @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div hidden class="row mb-3" id="callout_from_div">
                <label for="callout_from" class="col-md-4 col-form-label text-md-end">{{
                    __('cs2.map.grenade.form.optional') }}</label>
                <div class="col-md-6">
                    <select id="callout_from" name="callout_from_id"
                        class="form-control @error('callout_from') is-invalid @enderror">
                        <option value=""></option>
                        @foreach ($callouts as $callout)
                        <option value="{{ $callout->id }}">{{ $callout->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- AREA CALLOUT TO --}}
            <div class="row mb-3">
                <label for="area_to" class="col-md-4 col-form-label text-md-end">{{
                    __('cs2.map.grenade.form.throwing_to_(area)') }}</label>
                <div class="col-md-6">
                    <select id="area_to" name="area_to_id"
                        class="form-control @error('area_to_id') is-invalid @enderror" required>
                        <option value=""></option>
                        @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div hidden class="row mb-3" id="callout_to_div">
                <label for="callout_to" class="col-md-4 col-form-label text-md-end">{{
                    __('cs2.map.grenade.form.optional') }}</label>
                <div class="col-md-6">
                    <select id="callout_to" name="callout_to_id"
                        class="form-control @error('callout_to') is-invalid @enderror">
                        <option value=""></option>
                        @foreach ($callouts as $callout)
                        <option value="{{ $callout->id }}">{{ $callout->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- DESCRIPTION --}}
            <div class="row mb-3">
                <label for="description" class="col-md-4 col-form-label text-md-end">{{
                    __('cs2.map.grenade.form.description') }}</label>
                <div class="col-md-6">
                    <textarea placeholder="Max. 500 char" id="description" name="description"
                        class="form-control @error('description') is-invalid @enderror" maxlength="500"></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            {{-- RADIO FOR SOURCE --}}
            <div class="row mb-3">
                <label class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.source') }}</label>
                <div class="col-md-6">
                    <input type="radio" id="images_radio" name="source_type" value="images" {{
                        old('source_type')=='images' ? 'checked' : '' }} required> Images<br>

                    <input type="radio" id="youtube_radio" name="source_type" value="youtube_path" {{
                        old('source_type')=='youtube_path' ? 'checked' : '' }} required> YouTube Video<br>

                    @error('source_type')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            {{-- IMAGES --}}
            <div class="row mb-3" id="images_div" style="display:none">
                <label for="images" class="col-md-4 col-form-label text-md-end">
                    {{ __('cs2.map.grenade.form.images') }} <p>(drag and drop)</p>
                </label>
                <div class="col-md-6">
                    <input id="images" name="images[]" type="file" multiple accept="image/*"
                        class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror">
                    <div id="image-preview" class="row mt-3"></div>
                    @error('images')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            {{-- YOUTUBE PATH --}}
            <div class="row mb-3" style="display:none" id="youtube_div">
                <label for="youtube_path" class="col-md-4 col-form-label text-md-end">{{
                    __('cs2.map.grenade.form.youtube') }}</label>
                <div class="col-md-6">
                    <input type="url" name="youtube_path" id="youtube_path"
                        class="form-control @error('youtube_path') is-invalid @enderror"
                        pattern="https?:\/\/(www\.)?(youtube\.com|youtu\.be)\/.+" title="Podaj poprawny link do YouTube"
                        oninvalid="this.setCustomValidity('Wpisz poprawny link do YouTube')"
                        oninput="setCustomValidity('')">
                    @error('youtube_path')
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