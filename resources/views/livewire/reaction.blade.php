    <button wire:click="like" class="border-transparent btn btn-light bg-transparent">
        <i class="{{ $thread->isLiked() ? 'bi bi-hand-thumbs-up-fill' : ' bi bi-hand-thumbs-up' }}"></i>
        {{-- <span class="font-medium text-gray-900">{{ $count }}</span> --}}
    </button>