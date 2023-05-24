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
                        Add new Announcement
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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            @if (auth()->user()->isAdmin())
                                <th>Status</th>
                            @endif
                            <th>Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcements as $announcement)
                            <tr>
                                <td>{{ $announcement->title }}</td>
                                <td>{{ Str::limit($announcement->body, 70, '...') }}</td>
                                <td>{{ $announcement->created_at->format('M d, Y') }}</td>
                                @if (auth()->user()->isAdmin())
                                    <td class="text-center">
                                        <div class="form-check form-switch d-flex justify-content-center pl-0">
                                            <input class="form-check-input" type="checkbox"
                                                id="publishSwitch{{ $announcement->id }}" name="is_published" value="1"
                                                {{ $announcement->is_published ? 'checked' : '' }}
                                                onchange="event.preventDefault(); document.getElementById('publishForm{{ $announcement->id }}').submit();">
                                            <label class="form-check-label"
                                                for="publishSwitch{{ $announcement->id }}"></label>
                                            <form action="{{ route('dashboard.announcements.publish', $announcement->id) }}"
                                                method="POST" id="publishForm{{ $announcement->id }}"
                                                style="display:none;">
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                        </div>
                                    </td>
                                @endif
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.announcements.show', $announcement->id) }}">Show</a>
                                            @if (auth()->user()->isAdmin())
                                                <a href="{{ route('dashboard.announcements.show', $announcement->id) }}"
                                                    class="dropdown-item" data-toggle="modal"
                                                    data-target="#editModal{{ $announcement->id }}">
                                                    Edit </a>
                                                <form
                                                    action="{{ route('dashboard.announcements.destroy', $announcement->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="dropdown-item"
                                                        href="{{ route('dashboard.announcements.destroy', $announcement->id) }}"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">Delete</a>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                @if (auth()->user()->isAdmin())
                                    <td colspan="5">No announcements found.</td>
                                @endif
                                @if (auth()->user()->isUser())
                                    <td colspan="4">No announcements found.</td>
                                @endif
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $announcements->links('pagination::bootstrap-5', ['paginator' => $announcements]) }}

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
                                    <form id="announcementsFilterForm">
                                        <div class="form-row mb-3">
                                            <div class="form-group col-md-6">
                                                <label for="titleFilter">Title</label>
                                                <input type="text" class="form-control" id="titleFilter" name="title"
                                                    placeholder="Enter title">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="dateFilter">Date</label>
                                                <select class="form-control" id="dateFilter" name="date_operator">
                                                    <option value="eq">Equal to</option>
                                                    <option value="neq">Not equal to</option>
                                                    <option value="gt">After</option>
                                                    <option value="gte">On or after</option>
                                                    <option value="lt">Before</option>
                                                    <option value="lte">On or before</option>
                                                </select>
                                                <input type="date" class="form-control mt-2" id="dateFilterValue"
                                                    name="date_value">
                                            </div>
                                        </div>
                                        @if (auth()->user()->isAdmin())
                                            <div class="form-row mb-3">
                                                <div class="form-group col-md-6">
                                                    <label for="statusFilter">Status</label>
                                                    <select class="form-control" id="statusFilter" name="status">
                                                        <option value="">All</option>
                                                        <option value="1">Published</option>
                                                        <option value="0">Draft</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                                <button type="reset" class="btn btn-secondary">Reset
                                                    Filters</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Edit Modal --}}
                @foreach ($announcements as $announcement)
                    <div class="modal fade" id="editModal{{ $announcement->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editModal{{ $announcement->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('dashboard.announcements.update', $announcement->id) }}"
                                    method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModal{{ $announcement->id }}Label">Edit
                                            Announcement</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input value="{{ $announcement->title }}" type="text"
                                                class="form-control" id="title" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="body">Body</label>
                                            <textarea class="form-control" id="body" name="body">{{ $announcement->body }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
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
                            <form action="{{ route('dashboard.announcements.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createModalLabel">Add Announcement</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input value="{{ old('title') }}" type="text" class="form-control"
                                            id="title" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Body</label>
                                        <textarea class="form-control" id="body" name="body">{{ old('body') }}</textarea>
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
