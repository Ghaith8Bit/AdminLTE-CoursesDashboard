@extends('dashboard.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 3.5rem">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="card-title">{{ $announcement->title }}</h1>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $announcement->body }}</p>
                        <hr>
                        <h5>Announcement Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Status:</strong>
                                    {{ $announcement->published_at == 1 ? 'Published' : 'Draft' }}</p>
                                <p><strong>Date:</strong> {{ $announcement->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('dashboard.announcements.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
