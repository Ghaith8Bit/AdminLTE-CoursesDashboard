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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                    Add new User
                </button>
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
                            <th>Email</th>
                            <th>Date</th>
                            <th>Is Admin</th>
                            <th>Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-flex justify-content-center pl-0">
                                        <input class="form-check-input" type="checkbox" id="roleSwitch{{ $user->id }}"
                                            name="role_id" value="1" {{ $user->role_id == 2 ? 'checked' : '' }}
                                            onchange="event.preventDefault(); document.getElementById('roleForm{{ $user->id }}').submit();">
                                        <label class="form-check-label" for="roleSwitch{{ $user->id }}"></label>
                                        <form action="{{ route('dashboard.users.role', $user->id) }}" method="POST"
                                            id="roleForm{{ $user->id }}" style="display:none;">
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.users.show', $user->id) }}">Show</a>
                                            <a href="{{ route('dashboard.users.update', $user->id) }}"
                                                class="dropdown-item" data-toggle="modal"
                                                data-target="#editModal{{ $user->id }}">
                                                Edit </a>
                                            <form action="{{ route('dashboard.users.destroy', $user->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.users.destroy', $user->id) }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">Delete</a>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No announcements found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $users->appends(request()->query())->links('pagination::bootstrap-5', ['paginator' => $users]) }}

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
                                    <form id="usersFilterForm">
                                        <div class="form-row mb-3">
                                            <div class="form-group col-md-6">
                                                <label for="nameFilter">Name</label>
                                                <input type="text" class="form-control" id="nameFilter" name="name"
                                                    placeholder="Enter name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="emailFilter">Email</label>
                                                <input type="text" class="form-control" id="emailFilter" name="email"
                                                    placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="form-row mb-3">
                                            <div class="form-group col-md-6">
                                                <label for="dateFilter">Date</label>
                                                <select class="form-control" id="dateFilter" name="date_operator">
                                                    <option value="gt">After</option>
                                                    <option value="gte">On or after</option>
                                                    <option value="lt">Before</option>
                                                    <option value="lte">On or before</option>
                                                </select>
                                                <input type="date" class="form-control mt-2" id="dateFilterValue"
                                                    name="date_value">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="roleFilter">Role</label>
                                                <select class="form-control" id="roleFilter" name="role">
                                                    <option value="">All</option>
                                                    <option value="2">Admin</option>
                                                    <option value="1">User</option>
                                                </select>
                                            </div>
                                        </div>
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
                @foreach ($users as $user)
                    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editModal{{ $user->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModal{{ $user->id }}Label">Edit
                                            User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input value="{{ $user->name }}" type="text" class="form-control"
                                                id="name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input value="{{ $user->email }}" type="text" class="form-control"
                                                id="email" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
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
                            <form action="{{ route('dashboard.users.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createModalLabel">Add User</h5>
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
                                        <label for="email">Email</label>
                                        <input value="{{ old('email') }}" type="text" class="form-control"
                                            id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role_id">
                                            <option value="1" selected>User</option>
                                            <option value="2">Admin</option>
                                        </select>
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
