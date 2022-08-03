<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'subject',
        'content',
        'creator_id',
        'settings',
    ];

    protected $casts = [
        'settings' => 'object'
    ];

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }

    public static function createdByAuthUser()
    {
        return self::where('creator_id', auth()->id());
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
