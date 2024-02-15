@extends('layouts.app')
@section('content')

<div class="container">
  <section class="pt-5 pb-5">
    <div class="container w-100">
      <div class="row align-content-center">
        <a class="card p-2 col-md-3  no-gutters text-white" href=""> 
          <img class="card-img h-100 shadow"
            src="https://images.unsplash.com/photo-1517659649778-bae24b8c2e26?ixlib=rb-0.3.5&amp;s=6c3524e0ea8d0107f85384392d779467&amp;auto=format&amp;fit=crop&amp;w=666&amp;q=80" alt="Card image">
          <div class="card-img-overlay p-1 d-flex  flex-column  align-items-baseline justify-content-center ">
            <div class="container-fluid  h-50  text-center">
              <div class="row h-100 align-items-center">
                <div class="col-12">
                  <h1 class="  mt-3 mb-3">Mirage</h2>
                </div>
              </div>
            </div>
          </div>
        </a>
        <a class="card p-2 col-md-3  no-gutters text-white   " data-toggle="modal" data-target=".bd-example-modal-lg">
          <img class="card-img h-100 shadow"
            src="https://images.unsplash.com/photo-1443453489887-98f56bc5bb38?ixlib=rb-0.3.5&amp;s=13ea309e96c29da90ee6453003ba8408&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80"
            alt="Card image">
          <div class="card-img-overlay p-1 d-flex  flex-column  align-items-baseline justify-content-center ">
            <div class="container-fluid h-25">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <h3>1</h3>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">+28c</h5>
                </div>
              </div>
            </div>
            <div class="container-fluid  h-50  text-center">
              <div class="row h-100 align-items-center">
                <div class="col-12">
                  <h2 class="  mt-3 mb-3">New York<br><small>United States</small></h2>

                </div>
              </div>
            </div>
            <div class="container-fluid h-25  ">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <i class="far fa-sun fa-lg" aria-hidden="true"></i>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">$4,250</h5>
                </div>
              </div>
            </div>
          </div>
        </a>
        <a class="card p-2 col-md-3  no-gutters text-white   " data-toggle="modal" data-target=".bd-example-modal-lg">
          <img class="card-img h-100 shadow"
            src="https://images.unsplash.com/photo-1517659649778-bae24b8c2e26?ixlib=rb-0.3.5&amp;s=6c3524e0ea8d0107f85384392d779467&amp;auto=format&amp;fit=crop&amp;w=666&amp;q=80"
            alt="Card image">
          <div class="card-img-overlay p-1 d-flex  flex-column  align-items-baseline justify-content-center ">
            <div class="container-fluid h-25">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <h3>1</h3>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">+24c</h5>
                </div>
              </div>
            </div>
            <div class="container-fluid  h-50  text-center">
              <div class="row h-100 align-items-center">
                <div class="col-12">
                  <h2 class="  mt-3 mb-3">Barcelona<br><small> Spain</small></h2>

                </div>
              </div>
            </div>
            <div class="container-fluid h-25  ">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <i class="fa fa-cloud  fa-lg" aria-hidden="true"></i>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">$2,240</h5>
                </div>
              </div>
            </div>
          </div>
        </a>
        <a class="card p-2 col-md-3  no-gutters text-white   " data-toggle="modal" data-target=".bd-example-modal-lg">
          <img class="card-img h-100 shadow"
            src="https://images.unsplash.com/photo-1443453489887-98f56bc5bb38?ixlib=rb-0.3.5&amp;s=13ea309e96c29da90ee6453003ba8408&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80"
            alt="Card image">
          <div class="card-img-overlay p-1 d-flex  flex-column  align-items-baseline justify-content-center ">
            <div class="container-fluid h-25">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <h3>1</h3>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">+28c</h5>
                </div>
              </div>
            </div>
            <div class="container-fluid  h-50  text-center">
              <div class="row h-100 align-items-center">
                <div class="col-12">
                  <h2 class="  mt-3 mb-3">New York<br><small>United States</small></h2>

                </div>
              </div>
            </div>
            <div class="container-fluid h-25  ">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <i class="far fa-sun  fa-lg" aria-hidden="true"></i>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">$4,250</h5>
                </div>
              </div>
            </div>
          </div>
        </a>
        <a class="card p-2 col-md-3  no-gutters text-white   " data-toggle="modal" data-target=".bd-example-modal-lg">
          <img class="card-img h-100 shadow"
            src="https://images.unsplash.com/photo-1517659649778-bae24b8c2e26?ixlib=rb-0.3.5&amp;s=6c3524e0ea8d0107f85384392d779467&amp;auto=format&amp;fit=crop&amp;w=666&amp;q=80"
            alt="Card image">
          <div class="card-img-overlay p-1 d-flex  flex-column  align-items-baseline justify-content-center ">
            <div class="container-fluid h-25">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <h3>1</h3>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">+24c</h5>
                </div>
              </div>
            </div>
            <div class="container-fluid  h-50  text-center">
              <div class="row h-100 align-items-center">
                <div class="col-12">
                  <h2 class="  mt-3 mb-3">Barcelona<br><small> Spain</small></h2>

                </div>
              </div>
            </div>
            <div class="container-fluid h-25  ">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <i class="fa fa-cloud fa-lg" aria-hidden="true"></i>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">$2,240</h5>
                </div>
              </div>
            </div>
          </div>
        </a>
        <a class="card p-2 col-md-3  no-gutters text-white   " data-toggle="modal" data-target=".bd-example-modal-lg">
          <img class="card-img h-100 shadow"
            src="https://images.unsplash.com/photo-1443453489887-98f56bc5bb38?ixlib=rb-0.3.5&amp;s=13ea309e96c29da90ee6453003ba8408&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80"
            alt="Card image">
          <div class="card-img-overlay p-1 d-flex  flex-column  align-items-baseline justify-content-center ">
            <div class="container-fluid h-25">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <h3>1</h3>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">+28c</h5>
                </div>
              </div>
            </div>
            <div class="container-fluid  h-50  text-center">
              <div class="row h-100 align-items-center">
                <div class="col-12">
                  <h2 class="  mt-3 mb-3">New York<br><small>United States</small></h2>

                </div>
              </div>
            </div>
            <div class="container-fluid h-25  ">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <i class="far fa-sun fa-lg" aria-hidden="true"></i>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">$4,250</h5>
                </div>
              </div>
            </div>
          </div>
        </a>
        <a class="card p-2 col-md-3  no-gutters text-white   " data-toggle="modal" data-target=".bd-example-modal-lg">
          <img class="card-img h-100 shadow"
            src="https://images.unsplash.com/photo-1517659649778-bae24b8c2e26?ixlib=rb-0.3.5&amp;s=6c3524e0ea8d0107f85384392d779467&amp;auto=format&amp;fit=crop&amp;w=666&amp;q=80"
            alt="Card image">
          <div class="card-img-overlay p-1 d-flex  flex-column  align-items-baseline justify-content-center ">
            <div class="container-fluid h-25">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <h3>1</h3>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">+24c</h5>
                </div>
              </div>
            </div>
            <div class="container-fluid  h-50  text-center">
              <div class="row h-100 align-items-center">
                <div class="col-12">
                  <h2 class="  mt-3 mb-3">Barcelona<br><small> Spain</small></h2>

                </div>
              </div>
            </div>
            <div class="container-fluid h-25  ">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <i class="fa fa-cloud  fa-lg" aria-hidden="true"></i>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">$2,240</h5>
                </div>
              </div>
            </div>
          </div>
        </a>
        <a class="card p-2 col-md-3  no-gutters text-white   " data-toggle="modal" data-target=".bd-example-modal-lg">
          <img class="card-img h-100 shadow"
            src="https://images.unsplash.com/photo-1443453489887-98f56bc5bb38?ixlib=rb-0.3.5&amp;s=13ea309e96c29da90ee6453003ba8408&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80"
            alt="Card image">
          <div class="card-img-overlay p-1 d-flex  flex-column  align-items-baseline justify-content-center ">
            <div class="container-fluid h-25">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <h3>1</h3>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">+28c</h5>
                </div>
              </div>
            </div>
            <div class="container-fluid  h-50  text-center">
              <div class="row h-100 align-items-center">
                <div class="col-12">
                  <h2 class="  mt-3 mb-3">New York<br><small>United States</small></h2>

                </div>
              </div>
            </div>
            <div class="container-fluid h-25  ">
              <div class="row h-100 align-items-center">
                <div class="col-6">
                  <i class="far fa-sun  fa-lg" aria-hidden="true"></i>
                </div>
                <div class="col-6 text-right">
                  <h5 class="  mt-2 mb-2 text-white">$4,250</h5>
                </div>
              </div>
            </div>
          </div>
        </a>

      </div>
    </div>
  </section>
</div>

@endsection