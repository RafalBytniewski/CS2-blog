@extends('layouts.app')

@section('content')

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
                        <a href="">
                            <i class="fa-solid fa-trash btn btn-md btn-danger" title="{{ __('cs2.buttons.delete') }}"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection