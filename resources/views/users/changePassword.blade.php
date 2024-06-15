@extends('layouts/app')

@section('content')
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header fs-4">Change your password</div>
                <div class="card-body">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="oldPassword">Old password</label>
                            <input class="form-control" id="oldPassword" type="password" placeholder="Enter your old password" value="">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="oldPassword">New password</label>
                            <input class="form-control" id="oldPassword" type="password" placeholder="Enter your new password" value="">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="oldPassword">Confirm new password</label>
                            <input class="form-control" id="oldPassword" type="password" placeholder="Enter your new password" value="">
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="button">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection