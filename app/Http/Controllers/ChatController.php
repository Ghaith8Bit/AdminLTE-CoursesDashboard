<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chats = Chat::getChatsForUser(auth()->id());
        $admins = User::admin()->get();
        return view('dashboard.chats.index', ['chats' => $chats, 'admins' => $admins]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $admin_id)
    {
        $chat = Chat::getOrCreateChat(auth()->user()->id, $admin_id);
        return redirect()->route('dashboard.chats.show', [$chat->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        $this->authorize('view', $chat);
        $chat->markAsRead();
        $messages = Message::forChat($chat->id)->orderBy('created_at')->get();
        return view('dashboard.chats.show', ['chat' => $chat, 'messages' => $messages]);
    }

    public function message(Chat $chat, Request $request)
    {
        $this->authorize('sendMessage', $chat);
        Message::addMessage($request->content, $chat);
        $messages = Message::forChat($chat->id)->orderBy('created_at')->get();

        return view('dashboard.chats.show', ['chat' => $chat, 'messages' => $messages]);
    }
}
