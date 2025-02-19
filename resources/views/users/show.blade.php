@extends('layouts.app')

@section('content')

<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-12 col-xl-12">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="height:200px;">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                <img src="{{ asset('storage/images/avatars/avatar.jpg') }}" alt="Avatar of {{ $user->name }}" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                @can('isAdmin')  
                    <a href="{{ route('users.edit', $user->id) }}" type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-dark" data-mdb-ripple-color="dark"style="z-index: 1;">
                          Edit profile
                    </a>
                 @endcan
              </div>
              <div class="ms-3" style="margin-top: 130px;">
                <h3>{{ $user->name}}</h3>
              </div>
            </div>
            <div class="p-4 text-black" style="background-color: #f8f9fa;">
              <div class="d-flex justify-content-end text-center py-1">
                <div><strong>
                  <p class="mb-1 h5">-</p>
                  <p class="medium text-dark mb-0">Grenades added</p>
                </div>
                <div class="px-3">
                  <p class="mb-1 h5">-</p>
                  <p class="medium text-dark mb-0">Grenade followed</p>
                </div>
                <div>
                  <p class="mb-1 h5">-</p>
                  <p class="medium text-dark mb-0">Grenade liked</p>
                </strong></div>
              </div>
            </div>
            <div class="card-body p-4">

              <div id="recently_added_nades">
                <div class="d-flex justify-content-between align-items-center my-4">
                  <h1>Nades</h1>
                  <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
                </div>
                <div class="row g-2">
                  <div class="col-4 mb-2">
                    <img src="https://steamuserimages-a.akamaihd.net/ugc/2290706040601511204/E96DFCD5837DB816AC32A865802BC38CABFC5142/"
                      alt="image 1" class="w-100 rounded-3">
                  </div>
                  <div class="col-4 mb-2">
                    <img src="https://steamuserimages-a.akamaihd.net/ugc/2290706040601511204/E96DFCD5837DB816AC32A865802BC38CABFC5142/"
                      alt="image 1" class="w-100 rounded-3">
                  </div>
                  <div class="col-4 mb-2">
                    <img src="https://steamuserimages-a.akamaihd.net/ugc/2290706040601511204/E96DFCD5837DB816AC32A865802BC38CABFC5142/"
                      alt="image 1" class="w-100 rounded-3">
                  </div>
                  <div class="col-4">
                    <img src="https://steamuserimages-a.akamaihd.net/ugc/2290706040601511204/E96DFCD5837DB816AC32A865802BC38CABFC5142/"
                      alt="image 1" class="w-100 rounded-3">
                  </div>
                  <div class="col-4">
                    <img src="https://steamuserimages-a.akamaihd.net/ugc/2290706040601511204/E96DFCD5837DB816AC32A865802BC38CABFC5142/"
                      alt="image 1" class="w-100 rounded-3">
                  </div>                  
                  <div class="col-4">
                    <img src="https://steamuserimages-a.akamaihd.net/ugc/2290706040601511204/E96DFCD5837DB816AC32A865802BC38CABFC5142/"
                      alt="image 1" class="w-100 rounded-3">
                  </div>                  
                  <div class="col-4">
                    <img src="https://steamuserimages-a.akamaihd.net/ugc/2290706040601511204/E96DFCD5837DB816AC32A865802BC38CABFC5142/"
                      alt="image 1" class="w-100 rounded-3">
                  </div>                  
                  <div class="col-4">
                    <img src="https://steamuserimages-a.akamaihd.net/ugc/2290706040601511204/E96DFCD5837DB816AC32A865802BC38CABFC5142/"
                      alt="image 1" class="w-100 rounded-3">
                  </div>                  
                  <div class="col-4">
                    <img src="https://steamuserimages-a.akamaihd.net/ugc/2290706040601511204/E96DFCD5837DB816AC32A865802BC38CABFC5142/"
                      alt="image 1" class="w-100 rounded-3">
                  </div>
                </div>
              </div>
              <div id="favorite_nades">
                <div class="d-flex justify-content-between align-items-center my-4">
                  <h1>Groups</h1>
                  <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
                </div>
                <div class="row g-2">
                  <div class="col-4 mb-2">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(112).webp"
                      alt="image 1" class="w-100 rounded-3">
                  </div>
                  <div class="col-4 mb-2">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(107).webp"
                      alt="image 1" class="w-100 rounded-3">
                  </div>
                  <div class="col-4 mb-2">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(108).webp"
                      alt="image 1" class="w-100 rounded-3">
                  </div>
                  <div class="col-4">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(114).webp"
                      alt="image 1" class="w-100 rounded-3">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
