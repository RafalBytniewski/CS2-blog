@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card-header">
        <h1>{{__('cs2.maps.grenades.list')}}</h1>

    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('cs2.maps.grenades.map')}}</th>
                    <th scope="col">{{__('cs2.maps.grenades.user_name')}}</th>
                    <th scope="col">{{__('cs2.maps.grenades.describtion')}}</th>
                    <th scope="col">{{__('cs2.maps.grenades.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grenades as $grenade)
                <tr>
                    <th scope="row">{{$grenade->id}}</th>
                    <td>{{$grenade->map->name}}</td>
                    <td>{{$grenade->user->name}}</td>
                    <td>{{$grenade->describtion}}</td>
                    <td>
                        <a href="{{ route('grenade.show', $grenade->id) }}">
                            <button class="btn btn-sm btn-primary">V</button>
                        </a>
                        <a href="{{ route('grenade.edit', $grenade->id) }}">
                            <button class="btn btn-sm btn-secondary">E</button>
                        </a>
                        <a class="btn btn-sm btn-danger">X</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection