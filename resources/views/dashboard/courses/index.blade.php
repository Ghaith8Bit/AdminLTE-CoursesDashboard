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
    <div class="container">
        <div class="row mb-3" style="margin-top: 5rem">
            <div class="col-md-6">
                @if (auth()->user()->isAdmin())
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                        Add new Course
                    </button>
                @endif
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">
                    Filters & Search
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{ Str::limit($course->description, 70, '...') }}</td>
                                <td>{{ $course->price }}</td>
                                <td>{{ $course->start_date }}</td>
                                <td>{{ $course->end_date }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.courses.show', $course->id) }}">Show</a>
                                            @if (auth()->user()->isAdmin())
                                                <a href="#" class="dropdown-item" data-toggle="modal"
                                                    data-target="#editModal{{ $course->id }}">
                                                    Edit
                                                </a>
                                                <form action="{{ route('dashboard.courses.destroy', $course->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="dropdown-item"
                                                        href="{{ route('dashboard.courses.destroy', $course->id) }}"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">Delete</a>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No courses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $courses->appends(request()->query())->links('pagination::bootstrap-5', ['paginator' => $courses]) }}

                {{-- Filters Modal --}}
                <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <!-- Filter card content goes here -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Filters and Search</h5>
                                </div>
                                <div class="card-body px-4 py-3">
                                    <form id="coursesFilterForm">
                                        <div class="form-row mb-3">
                                            <div class="form-group col-md-6">
                                                <label for="nameFilter">Name</label>
                                                <input type="text" class="form-control" id="nameFilter" name="name"
                                                    placeholder="Enter name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="priceFilter">Price</label>
                                                <select class="form-control" id="priceFilter" name="price_operator">
                                                    <option value="eq">Equal to</option>
                                                    <option value="neq">Not equal to</option>
                                                    <option value="gt">Greater than</option>
                                                    <option value="gte">Greater than or equal to</option>
                                                    <option value="eq">Less than</option>
                                                    <option value="lte">Less than or equal to</option>
                                                </select>
                                                <input type="number" class="form-control mt-2" id="priceFilterValue"
                                                    name="price_value" placeholder="Enter price">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="startDateFilter">Start Date</label>
                                                <select class="form-control" id="startDateFilterOperator"
                                                    name="start_date_operator">
                                                    <option value="eq">Equal to</option>
                                                    <option value="neq">Not equal to</option>
                                                    <option value="gt">After</option>
                                                    <option value="gte">On or after</option>
                                                    <option value="lt">Before</option>
                                                    <option value="lte">On or before</option>
                                                </select>
                                                <input type="date" class="form-control mt-2" id="startDateFilterValue"
                                                    name="start_date_value">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="endDateFilter">End Date</label>
                                                <select class="form-control" id="endDateFilterOperator"
                                                    name="end_date_operator">
                                                    <option value="eq">Equal to</option>
                                                    <option value="neq">Not equal to</option>
                                                    <option value="gt">After</option>
                                                    <option value="gte">On or after</option>
                                                    <option value="lt">Before</option>
                                                    <option value="lte">On or before</option>
                                                </select>
                                                <input type="date" class="form-control mt-2" id="endDateFilterValue"
                                                    name="end_date_value">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                                <button type="reset" class="btn btn-secondary">Reset Filters</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Edit Modal --}}
                @foreach ($courses as $course)
                    <div class="modal fade" id="editModal{{ $course->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editModal{{ $course->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('dashboard.courses.update', $course->id) }}" method="POST"> @csrf
                                    @method('PUT') <div class="modal-header">
                                        <h5 class="modal-title" id="editModal{{ $course->id }}Label">Edit Course</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span> </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group"> <label for="name">Name</label> <input type="text"
                                                class="form-control" id="name" name="name"
                                                value="{{ $course->name }}"> </div>
                                        <div class="form-group"> <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description">{{ $course->description }}</textarea>
                                        </div>
                                        <div class="form-group"> <label for="price">Price</label> <input
                                                type="number" class="form-control" id="price" name="price"
                                                value="{{ $course->price }}"> </div>
                                        <div class="form-group"> <label for="start_date">Start Date</label> <input
                                                type="date" class="form-control" id="start_date" name="start_date"
                                                value="{{ $course->start_date }}"> </div>
                                        <div class="form-group"> <label for="end_date">End Date</label> <input
                                                type="date" class="form-control" id="end_date" name="end_date"
                                                value="{{ $course->end_date }}"> </div>
                                    </div>
                                    <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button> <button type="submit"
                                            class="btn btn-primary">Save changes</button> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Add Modal --}}
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
                    aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('dashboard.courses.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createModalLabel">Add Course</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input value="{{ old('name') }}" type="text" class="form-control"
                                            id="name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input value="{{ old('price') }}" type="number" class="form-control"
                                            id="price" name="price">
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input value="{{ old('start_date') }}" type="date" class="form-control"
                                            id="start_date" name="start_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input value="{{ old('end_date') }}" type="date" class="form-control"
                                            id="end_date" name="end_date">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
