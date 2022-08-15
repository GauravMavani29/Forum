<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $withCount = [
        'reactions',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(ThreadReply::class);
    }

    public function reactions()
    {
        return $this->hasMany(ThreadReaction::class);
    }

    public function isLiked()
    {
        if (auth()->user()) {
            return auth()->user()->reactions()->forThread($this)->count();
        }
        return false;
    }

    public function removeLike()
    {
        if (auth()->user()) {
            return auth()->user()->reactions()->forThread($this)->delete();
        }
        return false;
    }
}
