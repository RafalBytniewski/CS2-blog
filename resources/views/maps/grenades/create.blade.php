@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="card-header">
            <h1 style="text-align:center">Add new grenede</h1>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('grenade.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="map" class="col-md-4 col-form-label text-md-end">Map</label>
                    <div class="col-md-6">
                        <select id="map" name="map_id" class="form-control @error('map') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($maps as $map)
                                <option value="{{ $map->id }}">{{ $map->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-md-4 col-form-label text-md-end">Throwing as</label>
                    <div class="col-md-6">
                        <select id="team" name="team"
                            class="form-control @error('category_id') is-invalid @enderror" name="">

                            <option value=""></option>
                            <option value="t">Terrorist (T)</option>
                            <option value="ct">Counter-Terrorist (CT)</option>
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="type" class="col-md-4 col-form-label text-md-end">Type of nade</label>
                    <div class="col-md-6">
                        <select id="type" class="form-control @error('type') is-invalid @enderror" name="type">
                            <option value=""></option>
                            <option value="smoke">Smoke</option>
                            <option value="hegrenade">He Grenade</option>
                            <option value="flash">Flash</option>
                            <option value="molotov">Molotov</option>


                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="area" class="col-md-4 col-form-label text-md-end">Throwing from (area)</label>
                    <div class="col-md-6">
                        <select id="area" name="area_id" class="form-control @error('area') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="callout_from" class="col-md-4 col-form-label text-md-end">Throwing from (callout)</label>
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
                    <label for="area" class="col-md-4 col-form-label text-md-end">Throwing to (area)</label>
                    <div class="col-md-6">
                        <select id="area" name="area_id" class="form-control @error('area') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="callout_to" class="col-md-4 col-form-label text-md-end">Throwing to (callout)</label>
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
                    <label for="describtion" class="col-md-4 col-form-label text-md-end">Describtion</label>

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
                    <label for="images" class="col-md-4 col-form-label text-md-end">Images</label>

                    <div class="col-md-6">
                        <input id="images" name="images" type="file" multiple class="form-control @error('') is-invalid @enderror" autofocus>
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
