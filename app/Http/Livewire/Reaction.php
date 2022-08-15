<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Thread;
class Reaction extends Component
{
    public Thread $thread;
    public int $count;

    public function mount(Thread $thread)
    {
        $this->thread = $thread;
        $this->count = $thread->reactions_count??0;
    }

    public function like()
    {
        if ($this->thread->isLiked()) {
            $this->thread->removeLike();
            $this->count--;
        } elseif (auth()->user()) {
            $this->thread->reactions()->create([
                'thread_id' => $this->thread->id,
                'user_id' => auth()->id()
            ]);

            $this->count++;
        }
    }

   

    public function render()
    {
        return view('livewire.reaction');
    }
}
