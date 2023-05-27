<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'from_user_id',
        'to_user_id',
        'content',
        'read',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function markAsRead()
    {
        $this->read = true;
        $this->save();
    }

    public static function addMessage($content, $chat)
    {
        $message = self::create([
            'content' => $content,
            'chat_id' => $chat->id,
            'from_user_id' => auth()->user()->id,
            'to_user_id' => $chat->getOtherUserAttribute()->id,
            'read' => false,
        ]);
        $chat->update([
            'last_message_id' => $message->id
        ]);

        return $message;
    }

    public function scopeUnread($query)
    {
        return $query->where('to_user_id', auth()->id())->where('read', false);
    }

    public function scopeForChat($query, $chat_id)
    {
        return $query->where('chat_id', $chat_id);
    }
}
