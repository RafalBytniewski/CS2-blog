@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="card-header">
            <h1 style="text-align:center">{{__("cs2.map.grenade.add_form.add_grenade")}}</h1>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('grenade.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="map" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.add_form.map') }}</label>
                    <div class="col-md-6">
                        <input id="map" name="map_id" type="hidden" value="{{ $map->id }}">
                        <input id="map_name" name="map_name" type="text" value="{{ $map->name }}" readonly class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.add_form.team') }}</label>
                    <div class="col-md-6">
                        <select id="team" name="team"
                            class="form-control @error('category_id') is-invalid @enderror" name="">
                            <option value=""></option>
                            @foreach($teams as $team)
                                <option value="{{ $team }}">{{ $team }}</option>
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
                    <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.add_form.type') }}</label>
                    <div class="col-md-6">
                        <select id="type" class="form-control @error('type') is-invalid @enderror" name="type">
                            <option value=""></option>
                            @foreach($types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
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
                    <label for="area_from" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.add_form.throwing_from_(area)') }}</label>
                    <div class="col-md-6">
                        <select id="area_from" name="area_from_id" class="form-control @error('area') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div hidden class="row mb-3" id="callout_from_div" >
                    <label for="callout_from" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.add_form.optional') }}</label>
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
                    <label for="area_to" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.add_form.throwing_to_(area)') }}</label>
                    <div class="col-md-6">
                        <select id="area_to" name="area_to_id" class="form-control @error('area') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div hidden class="row mb-3" id="callout_to_div">
                    <label for="callout_to" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.add_form.optional') }}</label>
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
                    <label for="describtion" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.add_form.describtion') }}</label>

                    <div class="col-md-6">
                        <input id="describtion" name="describtion" type="text"
                            class="form-control @error('') is-invalid @enderror" value="" required
                            autocomplete="describtion" autofocus>
                        @error('describtion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.add_form.images') }}</label>

                    <div class="col-md-6">
                        <input id="images" name="images[]" type="file" multiple class="form-control @error('') is-invalid @enderror" autofocus>
                        @error('')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('cs2.map.grenade.add_form.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@section('js')
@vite(['resources/js/create_grenade.js'])
@endsection