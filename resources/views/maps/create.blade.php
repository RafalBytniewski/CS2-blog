@extends('layouts/app')

@section('content')

    <div class="container">
        <div class="card-header">
            <h1 style="text-align:center">{{__("cs2.map.forms.add_map_title")}}</h1>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('maps.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.forms.map_name') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('cs2.map.forms.description') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" autocomplete="description" autofocus>
                        @error('description')
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
                            <option value="1">Yes</option>
                            <option value="0">No</option>
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
                        <input id="image_path" name="image_path" type="file" multiple class="form-control @error('image_path') is-invalid @enderror" autofocus >
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
