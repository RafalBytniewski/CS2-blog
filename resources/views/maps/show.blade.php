@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card-header">
        <h1 style="text-align:center">{{$maps->name}}</h1>
    
        <a href="{{ route('maps.create', $maps->id) }}">
            <button class="btn btn-lg btn-outline-primary">
                Add grenede
            </button>
        </a>
        </div>
    <div class="card-body">
        @foreach($grenades as $grenade)
        <div class="card">
            <span>User name: {{$grenade->user->name}}</span>
            <span>Callout from: {{ $grenade->calloutFrom->name }}</span>
            <span>Callout to: {{ $grenade->calloutTo->name }}</span>
        </div>
        @endforeach

        @foreach($users as $user)
    <div class="card">
        <h4>User: {{ $user->name }}</h4>
        @foreach($user->grenades as $grenade)
            <span>Grenade type: {{ $grenade->type }}</span>
        @endforeach
    </div>
@endforeach
    </div>
</div>
@endsection