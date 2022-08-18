<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Thread;
use App\Models\ThreadReply;
use Auth;
class Reply extends Component
{
    public Thread $thread;
    public ThreadReply $threadreply;
    public $description;

    protected $listeners = ['thread-React' => 'react','reply-React' => 'replyreact'];


    public function mount(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function react($payload)
    {
        // $this->thread->toggleReaction('love');
        $this->thread->toggleReaction($payload['reaction']);
        // dd($this->thread->reacted());
        // if ($this->thread->isLiked()) {
        // } else{
        //     $this->thread->toggleReaction($reaction);
        // }
    }  
    
    public function replyreact($payload)
    {
        // $this->thread->toggleReaction('love');
        $this->threadreply = ThreadReply::find((int)$payload['replyid']);
        $this->threadreply->toggleReaction($payload['reaction']);
        // dd($this->thread->reacted());
        // if ($this->thread->isLiked()) {
        // } else{
        //     $this->thread->toggleReaction($reaction);
        // }
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

    public function render()
    {
        return view('livewire.reply');
    }

    
}
