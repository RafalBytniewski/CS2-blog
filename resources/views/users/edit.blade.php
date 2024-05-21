@extends('layouts/app')

@section('content')
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
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
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="nickname">Nickname</label>
                                <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="username">
                            </div>   
                        </div>

                        <div class="mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">New password</label>
                                <input class="form-control" id="inputFirstName" type="password" placeholder="Enter your old password" value="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Confirm new password</label>
                                <input class="form-control" id="inputFirstName" type="password" placeholder="Enter your new password" value="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Old password</label>
                                <input class="form-control" id="inputFirstName" type="password" placeholder="Confirm your new password" value="">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="button">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection