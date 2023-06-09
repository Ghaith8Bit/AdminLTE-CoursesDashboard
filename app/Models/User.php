<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the role that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function isAdmin()
    {
        return $this->role->id === 2;
    }

    public function isUser()
    {
        return $this->role->id === 1;
    }

    public function chats()
    {
        return Chat::where('user1_id', $this->id)->orWhere('user2_id', $this->id)->orderBy('created_at', 'DESC')->get();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public static function countAdmins()
    {
        return self::where('role_id', 2)->count();
    }

    public static function countUsers()
    {
        return self::where('role_id', 1)->count();
    }

    public function scopeAdmin($query)
    {
        return $query->where('role_id', 2);
    }
}
