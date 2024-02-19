@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card-header">
        <h1 style="text-align:center">{{$map->name}}</h1>
    </div>
    <div class="card-body">
        <a href="{{ route('maps.create', $map->id) }}">
            <button class="btn btn-lg btn-primary">
                Add grenede
            </button>
        </a>
    </div>
</div>
@endsection