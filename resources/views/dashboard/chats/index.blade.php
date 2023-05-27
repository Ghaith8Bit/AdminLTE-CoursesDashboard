@extends('dashboard.layouts.master')

@section('content')
    <div class="container" style="margin-top: 5rem">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-3">
                    @if (auth()->user()->isUser())
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <span>Chat List</span>
                                <a href="#" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addContactModal">Add
                                    Contact</a>
                            </div>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="list-group">
                            @forelse ($chats as $chat)
                                <a href="{{ route('dashboard.chats.show', $chat) }}"
                                    class="list-group-item list-group-item-action active d-flex justify-content-between align-items-center"
                                    data-chat="{{ $chat->id }}">
                                    <div>
                                        <h3>{{ $chat->getOtherUserAttribute()->name }}</h3>
                                        <br>
                                        <small>
                                            Last message:
                                            @if (null !== $chat->lastMessage())
                                                {{ $chat->lastMessage()->content }}
                                            @else
                                                {!! '<b>There is no messages yet</b>' !!}
                                            @endif
                                        </small>
                                        <br>
                                        <small>{{ $chat->updated_at->format('H:i (M d)') }}</small>
                                    </div>
                                    <span
                                        class="badge badge-primary ml-auto">{{ $chat->getUnreadMessagesCountAttribute() }}</span>
                                </a>
                            @empty
                                <p>No chats found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- Add Contact Modal -->
                <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog"
                    aria-labelledby="addContactModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addContactModalLabel">Add Contact</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                    @foreach ($admins as $admin)
                                        <form method="POST" action="{{ route('dashboard.chats.store', $admin->id) }}">
                                            @csrf
                                            <button type="submit"
                                                class="list-group-item list-group-item-action active text-decoration-none">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <p class="mb-0">{{ $admin->name }}</p>
                                                        <small class="text-muted">{{ $admin->email }}</small>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>
                                    @endforeach
                                    </u>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
