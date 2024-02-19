@extends('layouts/app')

@section('content')

<div class="container">
    <div class="card-header">
        <h1 style="text-align:center" |>Add new grenede</h1>
    </div>

    <div class="card-body">
        <form method="POST" action="">
            @csrf

            <div class="row mb-3">
                <label for="map" class="col-md-4 col-form-label text-md-end">Map</label>

                <div class="col-md-6">
                    <input id="map" type="text" class="form-control" name="map" value="{{ $selectedMap->name }}"
                        required autocomplete="name" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-md-4 col-form-label text-md-end">Throwing as</label>
                <div class="col-md-6">
                    <select id="" class="form-control @error('category_id') is-invalid @enderror" name="">
                        <option value="">Select team</option>
                        <option value="">T</option>
                        <option value="">CT</option>
                
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
</div>
                <div class="row mb-3">
                <label for="" class="col-md-4 col-form-label text-md-end">Throwing from(area)</label>
                <div class="col-md-6">
                    <select id="
                    " class="form-control @error('category_id') is-invalid @enderror" name="">
                        <option value="">Select callout</option>
                        <option value="">T Spawn</option>
                        <option value="">Mid</option>
                        <option value="B apps"></option>
                
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-md-4 col-form-label text-md-end">Throwing to(area)</label>

                <div class="col-md-6">
                    <input id="" type="text" class="form-control @error('') is-invalid @enderror" name="" value=""
                        required autocomplete="" autofocus>
                    @error('')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-md-4 col-form-label text-md-end">Throwing from</label>

                <div class="col-md-6">
                    <input id="" type="text" class="form-control @error('') is-invalid @enderror" name="" value=""
                        required autocomplete="" autofocus>
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
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

@endsection