<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Qirolab\Laravel\Reactions\Traits\Reactable;
use Qirolab\Laravel\Reactions\Contracts\ReactableInterface;

class Thread extends Model implements ReactableInterface
{
    use HasFactory, Reactable;
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(ThreadReply::class);
    }

    public function isLiked()
    {
        if (auth()->user()) {
            return $this->isReactBy(auth()->user());
        }
        return false;
    }

    public function removeLike()
    {
        if (auth()->user()) {
            return $this->removeReaction(); 
        }
        return false;
    }
}
