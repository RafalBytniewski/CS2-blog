@extends('layouts.app')

@section('content')


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
                                <div class="row">
                                    <form method="POST" action="{{ route('callout.update') }}">
                                    @csrf
                                    @method('PUT')
                                        <input type="hidden" name="callout_id" value="{{ $callout->id }}">
                                        <input type="text" name="name" value="{{ $callout->name }}">
                                        
                                        <i type="submit" title="{{ __('cs2.buttons.edit')}}" class="fa-solid fa-square-check btn btn-sm btn-success"></i>
                                    </form>
                                    <form method="POST" action="{{ route('callout.destroy', $callout->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <i title="{{ __('cs2.buttons.delete')}}" class="fa-solid fa-trash btn btn-sm btn-danger" type="submit"></i>                                   
                                    </form>
                                </div>
                            @endforeach
                        </td>
                    @endforeach
                    </tr>
                </tbody>
                </tfoot>
                    <tr>
                        @foreach($areas as $area)
                        <td>                                                 
                            <form method="POST" action="{{ route('callout.store') }}">
                                @csrf
                                <input type="hidden" name="area_id" value="{{ $area->id }}">
                                <input type="text" name="name" value="">
                                <button type="submit" class="btn">Add</button>
                            </form>
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