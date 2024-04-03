@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card-header">
        <h1>{{ __('cs2.map.index.title') }}</h1>

    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('cs2.map.index.name') }}</th>
                    <th scope="col">{{ __('cs2.map.index.describtion') }}</th>
                    <th scope="col">{{ __('cs2.map.index.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($maps as $map)
                <tr>
                    <th scope="row">{{$map->id}}</th>
                    <td>{{$map->name}}</td>
                    <td>{{$map->describtion}}</td>
                    <td>
                        <a href="{{ route('maps.show', $map->id) }}">
                            <button title="{{ __('cs2.buttons.view') }}"class="btn btn-sm btn-primary">V</button>
                        </a>
                        <a title="{{ __('cs2.buttons.edit') }}" class="btn btn-sm btn-secondary">E</a>
                        <a title="{{ __('cs2.buttons.delete') }}" class="btn btn-sm btn-danger">X</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection