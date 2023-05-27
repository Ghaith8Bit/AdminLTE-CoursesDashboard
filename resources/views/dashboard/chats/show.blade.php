@extends('dashboard.layouts.master')

@section('content')
    <div class="container-fluid" style="margin-top: 5rem">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg elevation-5">
                    <div class="card-header bg-primary text-white rounded-top">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('dashboard.chats.index') }}" class="btn btn-secondary"><i
                                        class="fas fa-arrow-left"></i></a>
                            </div>
                            <div class="col">
                                <h4 class="mb-0"> <a class="active"
                                        href="{{ route('dashboard.users.show', $chat->getOtherUserAttribute()->id) }}">{{ $chat->getOtherUserAttribute()->name }}</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="height: 400px; overflow-y: scroll; padding-right: 15px;" id="chat-card">
                        <div class="row">
                            @foreach ($messages as $message)
                                <div class="col-12">
                                    @if ($message->from_user_id === auth()->user()->id)
                                        <div class="bg-light text-white mb-2 d-inline-block text-end px-3 py-2 rounded-lg">
                                            <p class="mb-0 d-inline-block">{{ $message->content }}</p>
                                            <small class="d-block">
                                                {{ $message->created_at->format('H:i') }} <i
                                                    class="fa @if ($message->read) fa-eye text-success @else fa-eye-slash text-danger @endif"></i></small>
                                        </div>
                                    @else
                                        <div class="bg-primary mb-2 d-inline-block px-3 py-2 rounded-lg float-right">
                                            <p class="mb-0 d-inline-block">{{ $message->content }}</p>
                                            <small class="d-block">
                                                {{ $message->created_at->format('H:i') }} <i
                                                    class="fa @if ($message->read) fa-eye text-success @else fa-eye-slash text-danger @endif"></i></small>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer bg-grey rounded-bottom">
                        <form method="POST" action="{{ route('dashboard.chats.message', $chat) }}">
                            @csrf
                            @method('POST')
                            <div class="input-group">
                                <input name="content" type="text" class="form-control border-0 rounded-0 shadow-sm"
                                    placeholder="Type your message here">
                                <div class="input-group-append">
                                    <button class="btn btn-primary rounded-0 shadow-sm" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
