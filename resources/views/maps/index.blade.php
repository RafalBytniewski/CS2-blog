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
        <div class=" d-flex justify-content-end">
            <a href="{{ route('maps.create') }}">
                <button class="btn btn-lg btn-outline-primary my-2">
                    {{ __('cs2.buttons.add_map')}}
                </button>
            </a>
        </div>
        <h1>{{ __('cs2.map.index.title') }}</h1>

    </div>
    <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('cs2.map.index.name') }}</th>
                        <th scope="col">{{ __('cs2.map.index.active') }}</th>
                        <th scope="col">{{ __('cs2.map.index.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maps as $map)
                    <tr>
                        <th scope="row">{{$map->id}}</th>
                        <td>{{$map->name}}</td>
                        <td>{{$map->active}}</td>
                        <td>
                            <a href="{{ route('maps.show', $map->id) }}">
                                <i title="{{ __('cs2.buttons.view') }}" class="fa-solid fa-magnifying-glass btn btn-md btn-primary"></i>
                            </a>
                            <a href="{{ route('maps.edit', $map->id) }}">
                                <i class="fa-solid fa-pen-to-square btn btn-md btn-success" title="{{ __('cs2.buttons.edit') }}"></i>
                            </a>
                            <a href="{{ route('maps.settings', $map->id) }}">
                                <i class="fa-solid fa-gear btn btn-md btn-secondary" title="{{ __('cs2.buttons.settings') }}"></i>
                            </a>
                            <form action="{{ route('map.destroy', $map->id) }}" method="POST" class="d-inline">
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
