<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ThreadReply as TR;
use App\Models\Thread;
use App\Models\User;
use Auth;
class ThreadReply extends Component
{
    public TR $reply;
    public function mount(TR $reply)
    {
        $this->reply = $reply;
    }

    public function react($reaction)
    {
        if ($this->reply->isLiked()) {
            $this->reply->toggleReaction($reaction);
            if($reaction == $this->reply->reacted()?->type){
                if($reaction == 'hand-thumbs-down-fill' || $reaction == 'emoji-frown-fill' ){
                    $user = User::find($this->reply->user->id)->increment('reactions', 1);
                }else{
                    $user = User::find($this->reply->user->id)->decrement('reactions', 1);
                }
            }else{
                $negative = ['hand-thumbs-down-fill','emoji-frown-fill'];
                $positive = ['hand-thumbs-up-fill','emoji-heart-eyes-fill','heart-fil'];
                if(in_array($reaction,$negative)){
                    if(!in_array($this->reply->reacted()->type,$negative)){
                        $user = User::find($this->reply->user->id)->decrement('reactions', 2);
                    }
                }else{
                    if(!in_array($this->reply->reacted()->type,$positive)){
                        $user = User::find($this->reply->user->id)->increment('reactions', 1);
                    }
                }
            }
        } else{
            $this->reply->toggleReaction($reaction);
            if($reaction == 'hand-thumbs-down-fill' || $reaction == 'emoji-frown-fill' ){
                $user = User::find($this->reply->user->id)->decrement('reactions', 1);
            }else{
                $user = User::find($this->reply->user->id)->increment('reactions', 1);
            }
        }
        $this->reply = TR::find($this->reply->id);
        $this->dispatchBrowserEvent('replyreaction');
    }

    public function render()
    {
        return view('livewire.thread-reply');
    }
}
