<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'user_id',
        'other_user_id',
        'message',
        'group_id',
        'is_read',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }
    public function recipient()
    {
        return $this->belongsTo(User::class, 'other_user_id');
    }
    public $timestamps = true;
}
