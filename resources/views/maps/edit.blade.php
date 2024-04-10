@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="card-header">
            <h1 style="text-align:center">Edit map: {{ $map->name }}</h1>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('maps.update', $map->id )}}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.forms.map_name') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="name" name="name" value="{{ $map->name }}"class="form-control @error('name') is-invalid @enderror" autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="describtion" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.forms.describtion') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="describtion" name="describtion" value="{{ $map->describtion }}"class="form-control @error('describtion') is-invalid @enderror" autocomplete="describtion" autofocus>
                        @error('describtion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="active" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.forms.active') }}</label>
                    <div class="col-md-6">
                        <select id="active" name="active" class="form-select @error('active') is-invalid @enderror" autofocus>
                            <option value="1" {{ $map->active == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $map->active == 0 ? 'selected' : '' }}>No</option>
                        </select>
                        @error('active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image_path" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.forms.image') }}</label>
                    <div class="col-md-6">
                        @if($map->image_path)
                            <img src="{{ asset('storage/' . $map->image_path) }}" alt="Current Image" class="mb-2" style="max-width: 100%">
                        @endif
                        <input id="image_path" name="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" autofocus>
                        @error('image_path')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('cs2.map.forms.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
