@extends('dashboard.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 3.5rem">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title">{{ $course->name }}</h1>
                        <p class="card-text">{{ $course->description }}</p>
                        <hr>
                        <h5>Course Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Price:</strong> ${{ $course->price }}</p>
                                <p><strong>Start Date:</strong> {{ $course->start_date }}</p>
                                <p><strong>End Date:</strong> {{ $course->end_date }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Date:</strong>{{ $course->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('dashboard.courses.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
