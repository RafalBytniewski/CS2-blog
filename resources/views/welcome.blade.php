@extends('layouts.app')
@section('content')

<div class="container">
  <section class="pt-5 pb-5">
    <div class="container w-100">
      <div class="row align-content-center">
  @foreach($maps as $map)
        <a class="card p-2 col-md-3  no-gutters text-white" href="">
          <img class="card-img h-100 shadow"
            src="https://images.unsplash.com/photo-1517659649778-bae24b8c2e26?ixlib=rb-0.3.5&amp;s=6c3524e0ea8d0107f85384392d779467&amp;auto=format&amp;fit=crop&amp;w=666&amp;q=80"
            alt="Card image">
          <div class="card-img-overlay p-1 d-flex  flex-column  align-items-baseline justify-content-center ">
            <div class="container-fluid  h-50  text-center">
              <div class="row h-100 align-items-center">
                <div class="col-12">
                  <h1 class="  mt-3 mb-3">{{$map->name}}</h2>
                </div>
              </div>
            </div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </section>
</div>

@endsection