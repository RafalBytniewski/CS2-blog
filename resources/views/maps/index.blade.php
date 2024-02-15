@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card-header">
        <h1>Maps list</h1>

    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Describtion</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($maps as $map)
                <tr>
                    <th scope="row">{{$map->id}}</th>
                    <td>{{$map->name}}</td>
                    <td>{{$map->describtion}}</td>
                    <td>
                        <a class="btn btn-sm btn-primary">V</a>
                        <a class="btn btn-sm btn-secondary">E</a>
                        <a class="btn btn-sm btn-danger">X</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection