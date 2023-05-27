@extends('dashboard.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 3.5rem">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="card-title">{{ $user->name }}</h1>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="card-text"><strong>Role:</strong> {{ $user->role_id == 1 ? 'User' : 'Admin' }}</p>
                        <p class="card-text"><strong>Created:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
