<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Thread;
use App\Models\User;
use App\Models\ThreadReply;
use Auth;

class ThreadDisplay extends Component
{   
    public Thread $thread;
    public ThreadReply $threadreply;
    public $description;
    
    protected $listeners = ['update-thread' => 'updatethread'];

    public function mount(Thread $thread)
    {
        $this->thread = $thread;
        // dd($this->thread);
    }

    public function react($reaction)
    {
        if ($this->thread->isLiked()) {
            $this->thread->toggleReaction($reaction);
            if($reaction == $this->thread->reacted()?->type){
                if($reaction == 'hand-thumbs-down-fill' || $reaction == 'emoji-frown-fill' ){
                    $user = User::find($this->thread->user->id)->increment('reactions', 1);
                }else{
                    $user = User::find($this->thread->user->id)->decrement('reactions', 1);
                }
            }else{
                $negative = ['hand-thumbs-down-fill','emoji-frown-fill'];
                $positive = ['hand-thumbs-up-fill','emoji-heart-eyes-fill','heart-fil'];
                if(in_array($reaction,$negative)){
                    if(!in_array($this->thread->reacted()->type,$negative)){
                        $user = User::find($this->thread->user->id)->decrement('reactions', 2);
                    }
                }else{
                    if(!in_array($this->thread->reacted()->type,$positive)){
                        $user = User::find($this->thread->user->id)->increment('reactions', 1);
                    }
                }
            }
        } else{
            $this->thread->toggleReaction($reaction);
            if($reaction == 'hand-thumbs-down-fill' || $reaction == 'emoji-frown-fill' ){
                $user = User::find($this->thread->user->id)->decrement('reactions', 1);
            }else{
                $user = User::find($this->thread->user->id)->increment('reactions', 1);
            }
        }
        $this->thread = Thread::find($this->thread->id);
    }
    
    public function replysubmit(){
        $threadreply = new ThreadReply();
        $threadreply->thread_id = $this->thread->id;
        $threadreply->user_id = Auth::user()->id;
        $threadreply->description = $this->description;
        $this->description = '';
        $threadreply->save();
        $this->dispatchBrowserEvent('threadreplysent');
    }

    public function updatethread(){
        $this->thread = Thread::find($this->thread->id);
    }


    public function render()
    {
        return view('livewire.thread-display');
    }
}
