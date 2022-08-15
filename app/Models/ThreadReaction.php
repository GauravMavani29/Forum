<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreadReaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'thread_id',
        'user_id',
    ];

    public function scopeForThread($query, Thread $thread)
    {
        return $query->where('thread_id', $thread->id);
    }

}
