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
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}">
                            <i class="fa-solid fa-magnifying-glass btn btn-md btn-primary"></i>
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}">
                            <i class="fa-solid fa-pen-to-square btn btn-md btn-success"></i>
                        </a>
                        <a href="">
                            <i class="fa-solid fa-trash btn btn-md btn-danger"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection