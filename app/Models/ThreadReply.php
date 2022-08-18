<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Qirolab\Laravel\Reactions\Traits\Reactable;
use Qirolab\Laravel\Reactions\Contracts\ReactableInterface;

class ThreadReply extends Model implements ReactableInterface
{
    use HasFactory, Reactable;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function isLiked()
    {
        if (auth()->user()) {
            return $this->is_reacted;
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
