@extends('layouts/app')
@section('content')
@vite(['resources/js/create_grenade.js','resources/js/sortable.js'])
    <div class="container">
        <div class="card-header">
            <h1 style="text-align:center">{{__("cs2.map.grenade.form.edit_title")}}</h1>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('grenade.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="map" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.map') }}</label>
                    <div class="col-md-6">
                        <input id="map" name="map_id" type="hidden" value="{{ $map->id }}">
                        <input id="map_name" name="map_name" type="text" value="{{ $map->name }}" readonly class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.team') }}</label>
                    <div class="col-md-6">
                        <select id="team" name="team"
                            class="form-control @error('category_id') is-invalid @enderror" name="">
                            <option value=""></option>
                            @foreach ($teams as $team)
                                <option value="{{ $team }}" @if($team == $grenade->team) selected @endif>{{ $team }}</option>
                            @endforeach
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
                        <select id="type" class="form-control @error('type') is-invalid @enderror" name="type">
                            <option value=""></option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}" @if($type == $grenade->type) selected @endif>{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="area_from" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.throwing_from_(area)') }}</label>
                    <div class="col-md-6">
                        <select id="area_from" name="area_from_id" class="form-control @error('area') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" @if($area->id == $areaFrom->id) selected @endif>{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3" id="callout_from_div" >
                    <label for="callout_from" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.optional') }}</label>
                    <div class="col-md-6">
                        <select id="callout_from" name="callout_from_id" class="form-control @error('callout_from') is-invalid @enderror">
                            <option placeholder="select"  value=""></option>
                            @foreach ($callouts as $callout)
                                <option value="{{ $callout->id }}"@if(isset($calloutFrom->id) && ($callout->id == $calloutFrom->id)) selected @endif>{{ $callout->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="area_to" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.throwing_to_(area)') }}</label>
                    <div class="col-md-6">
                        <select id="area_to" name="area_to_id" class="form-control @error('area') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}"@if($area->id == $areaFrom->id) selected @endif>{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3" id="callout_to_div">
                    <label for="callout_to" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.optional') }}</label>
                    <div class="col-md-6">
                        <select id="callout_to" name="callout_to_id" class="form-control @error('callout_to') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($callouts as $callout)
                                <option value="{{ $callout->id }}"@if(isset($calloutTo->id) && ($callout->id == $calloutTo->id)) selected @endif>{{ $callout->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="describtion" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.describtion') }}</label>

                    <div class="col-md-6">
                        <input id="describtion" name="describtion" type="text"
                            class="form-control @error('') is-invalid @enderror" value="{{$grenade->describtion}}" required
                            autocomplete="describtion" autofocus>
                        @error('describtion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.images') }}<p>(drag and drop)</p></label>
                    
                    <div class="row col-md-8" id="images-list">
                        @foreach($images as $index => $image)
                            <div class="col-md-3 mb-3">
                                <div data-image-id="{{ $image->id }}" class="image-item position-relative">
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="image" class="img-thumbnail">
                                    <span class="badge bg-secondary position-absolute bottom-0 start-50 translate-middle-x">{{ $index + 1 }}/{{ count($images) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>         
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('cs2.map.grenade.form.update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection