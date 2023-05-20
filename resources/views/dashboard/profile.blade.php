@extends('dashboard.layouts.master')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert" style="margin-top: 3.5rem">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert" style="margin-top: 3.5rem">
            {{ session('error') }}
        </div>
    @endif
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"></a>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Change Name
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('dashboard.profile.updateName') }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="inputName">New Name</label>
                                <input name="name" type="text" class="form-control" id="inputName"
                                    placeholder="Enter new name">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Change Password
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('dashboard.profile.updatePassword') }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="inputPassword1">New Password</label>
                                <input name="new_password" type="password" class="form-control" id="inputPassword1"
                                    placeholder="Enter new password">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword2">Confirm Password</label>
                                <input name="confirm_password" type="password" class="form-control" id="inputPassword2"
                                    placeholder="Confirm new password">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3">Old Password</label>
                                <input name="old_password" type="password" class="form-control" id="inputPassword3"
                                    placeholder="Enter old password">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
