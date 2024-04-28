@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container">
    <div class="card-header">
        <h1>{{__('cs2.map.grenade.table.index_title')}}</h1>

    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('cs2.map.grenade.table.map')}}</th>
                    <th scope="col">{{__('cs2.map.grenade.table.user')}}</th>
                    <th scope="col">{{__('cs2.map.grenade.table.description')}}</th>
                    <th scope="col">{{__('cs2.map.grenade.table.actions')}}</th>
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
                            <i title="{{ __('cs2.buttons.view') }}" class="fa-solid fa-magnifying-glass btn btn-md btn-primary"></i>
                        </a>
                        <a href="{{ route('grenade.edit', $grenade->id) }}">
                            <i class="fa-solid fa-pen-to-square btn btn-md btn-success" title="{{ __('cs2.buttons.edit') }}"></i>
                        </a>
                        <form action="{{ route('grenade.destroy', $grenade->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')            
                                <button class="fa-solid fa-trash btn btn-md btn-danger" title="{{ __('cs2.buttons.delete') }}" onclick="return confirm('Czy na pewno chcesz usunąć ten element?')"></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
@vite(['resources/js/alerts.js'])
@endsection