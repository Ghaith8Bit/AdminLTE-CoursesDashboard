<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user1_id',
        'user2_id',
        'last_message_id',
    ];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function getOtherUserAttribute()
    {
        return $this->user1_id === auth()->id() ? $this->user2 : $this->user1;
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getUnreadMessagesCountAttribute()
    {
        return $this->messages()->where('read', false)->where('to_user_id', auth()->user()->id)->count();
    }

    public function markAsRead()
    {
        $messages = $this->messages()->where('read', false)->where('to_user_id', auth()->id())->get();
        foreach ($messages as $message) {
            $message->update([
                'read' => true
            ]);
        }
    }

    public function lastMessage()
    {
        return $this->messages()->orderByDesc('created_at')->first();
    }

    public static function getChatByUser($user_id)
    {
        return Chat::where('user1_id', $user_id)->orWhere('user2_id', $user_id)->first();
    }

    public function hasUser(Authenticatable $user)
    {
        return $this->user1_id === $user->id || $this->user2_id === $user->id;
    }

    public static function getOrCreateChat($user_id, $other_user_id)
    {
        $chat = Chat::where(function ($query) use ($user_id, $other_user_id) {
            $query->where('user1_id', $user_id)->where('user2_id', $other_user_id);
        })->orWhere(function ($query) use ($user_id, $other_user_id) {
            $query->where('user1_id', $other_user_id)->where('user2_id', $user_id);
        })->first();

        if (!$chat) {
            $chat = Chat::create([
                'user1_id' => $user_id,
                'user2_id' => $other_user_id,
            ]);
        }

        return $chat;
    }

    public static function getChatsForUser($user_id)
    {
        return Chat::where('user1_id', $user_id)->orWhere('user2_id', $user_id)->orderByDesc('updated_at')->get();
    }
}
