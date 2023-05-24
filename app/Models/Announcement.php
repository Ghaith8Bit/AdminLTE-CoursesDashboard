<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
        'is_published'
    ];

    public static function countActiveAnnouncement()
    {
        return self::where('is_published', true)->count();
    }

    public function scopeLatestAnnouncements($query)
    {
        return $query->latest()->take(5)->get();
    }
}
