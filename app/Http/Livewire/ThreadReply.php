<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Thread;
use App\Models\ThreadReply as TH;
use Auth;
class ThreadReply extends Component
{
    public Thread $thread;
    public $description;

    public function mount(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function replysubmit(){
        $threadreply = new TH();
        $threadreply->thread_id = $this->thread->id;
        $threadreply->user_id = Auth::user()->id;
        $threadreply->description = $this->description;
        $this->description = '';
        $threadreply->save();
        $this->dispatchBrowserEvent('threadreplysent');
    }

    public function render()
    {
        return view('livewire.thread-reply');
    }
}
