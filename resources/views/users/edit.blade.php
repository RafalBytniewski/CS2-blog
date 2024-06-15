@extends('layouts/app')

@section('content')
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header  fs-4">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img src="{{ asset('storage/images/avatars/avatar.jpg') }}" alt="Avatar of {{ $user->name }}" class="img-account-profile rounded-circle mb-2" style="width: 200px">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload new image</button>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header fs-4">Account Details</div>
                <div class="card-body">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="">
                        </div>
                        <!-- Form Row-->
                        <div class="mb-3">
                            <label class="small mb-1" for="about">About you</label>
                            <textarea class="form-control" id="about" type="text" placeholder="Write something about you"></textarea>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="button">Save changes</button>
                    </form>
                </div>       
            </div>
            <div class="">
                <a href="" class="btn btn-outline-danger" type="button">Change e-mail address</a>
                <a href="{{route('users.changePassword', $user->id) }}" class="btn btn-outline-danger" type="button">Change password</a>
            </div> 
        </div>
    </div>
</div>
@endsection