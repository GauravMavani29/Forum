<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Thread;
use App\Models\ThreadReply;
use Auth;
class Reply extends Component
{
    public Thread $thread;
    public int $count;
    public $description;

    public function mount(Thread $thread)
    {
        $this->thread = $thread;
        $this->count = $thread->reactions_count??0;
    }

    public function like()
    {
        $this->thread->toggleReaction('love');
        // if ($this->thread->isLiked()) {
        //     $this->thread->removeLike();
        //     $this->count--;
        // } elseif (auth()->user()) {
        //     // $this->thread->reactions()->create([
        //     //     'thread_id' => $this->thread->id,
        //     //     'user_id' => auth()->id(),
        //     // ]);

        //     $this->count++;
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
