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
                                <i title="{{ __('cs2.buttons.view') }}" class="fa-solid fa-magnifying-glass btn btn-md btn-primary"></i>
                            </a>
                            <a href="">
                                <i class="fa-solid fa-pen-to-square btn btn-md btn-success" title="{{ __('cs2.buttons.edit') }}"></i>
                            </a>
                            <a href="{{ route('maps.settings', $map->id) }}">
                                <i class="fa-solid fa-gear btn btn-md btn-secondary" title="{{ __('cs2.buttons.settings') }}"></i>
                            </a>
                            <i class="fa-solid fa-trash btn btn-md btn-danger" title="{{ __('cs2.buttons.delete') }}"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
@endsection