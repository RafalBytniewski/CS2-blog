@extends('layouts.app')

@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="container">
    <div class="card-header d-flex flex-column">
        <h1 class="fs-1 fw-bold my-4" style="text-align:center">{{$map->name}}</h1>
    </div>
    <div class="card-body">
        <div class="container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        @foreach($areas as $area)
                        <th>{{ $area->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($areas as $area)
                        <td>
                            @foreach($area->callouts as $callout)
                            <p>{{ $callout->name }} <a class="btn" href="">E</a><a class="btn" href="">X</a></p>
                            @endforeach
                        </td>
                        @endforeach
                    </tr>
                </tbody>
                </tfoot>
                    <tr>
                        @foreach($areas as $area)
                        <td>                          
                            <button>+</button>
                        </td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection


@section('js')
@endsection