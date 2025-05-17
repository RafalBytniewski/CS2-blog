@extends('layouts/app')
@section('content')

@vite(['resources/js/createGrenade.js','resources/js/sortableGrenade.js'])
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="card-header">
            <h1 style="text-align:center">{{__("cs2.map.grenade.form.edit_title")}}</h1>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('grenade.update', $grenade->id) }}" enctype="multipart/form-data">
                
                @csrf
                @method('PUT')

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
                    <label for="visibility" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.visibility') }}</label>
                    <div class="col-md-6">
                        <select id="visibility" name="visibility" class="form-control @error('visibility') is-invalid @enderror" required>
                            <option value="" {{ $visibility === null ? 'selected' : '' }}></option>
                            <option value="0" {{ $visibility == '0' ? 'selected' : '' }}>{{ __('cs2.map.grenade.form.private') }}</option>
                            <option value="1" {{ $visibility == '1' ? 'selected' : '' }}>{{ __('cs2.map.grenade.form.public') }}</option>
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
                    <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.description') }}</label>

                    <div class="col-md-6">
                        <input id="description" name="description" type="text"
                            class="form-control @error('') is-invalid @enderror" value="{{$grenade->description}}" autocomplete="description" autofocus>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="source" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.source') }}</label>
                    <div class="col-md-6">
                        <input type="radio" id="images_radio" name="source_type" value="images"
                        @if(old('source_type', $grenade->source_type) === 'images') checked @endif
                        @if($grenade->source_type !== 'images') disabled @endif>
                        Images<br>
                
                        <input type="radio" id="youtube_radio" name="source_type" value="youtube_path"
                        @if(old('source_type', $grenade->source_type) === 'youtube_path') checked @endif
                        @if($grenade->source_type !== 'youtube_path') disabled @endif>
                        YouTube Video<br>
                    </div>
                </div>
                
                <div class="row mb-3" style="display:none" id="youtube_div">
                    <label for="youtube_path" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.grenade.form.youtube') }}</label>
                    <div class="col-md-6">
                    <input type="text" name="youtube_path" id="youtube_path" value="{{$grenade->youtube_path}}" class="form-control @error('youtube_path') is-invalid @enderror">
                        @error('youtube_path')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div id="image-meta-container"></div>

                <div class="row mb-3" style="display:none" id="images_div">
                    <label for="images" class="col-md-4 col-form-label text-md-end">
                        {{ __('cs2.map.grenade.form.images') }}
                    </label>
                    <div class="col-md-6">
                        <input type="file" id="images" name="images[]" multiple class="form-control mb-3">
                        <div class="row" id="image-preview">
                            @foreach($images as $index => $image)
                            <div class="col-md-6 mb-3 image-item" data-index="{{ $index }}" data-type="{{ $image->type }}">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="image" class="img-thumbnail">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-image">X</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
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