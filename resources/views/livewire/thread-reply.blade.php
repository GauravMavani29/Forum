<div class="row no-gutters border m-1 p-2  parent-social">
    <div class="col-12 col-md-2 col-sm-12">
        <div class="card d-flex justify-content-center align-items-center" style="width: 100%;">
            <img src="{{ asset('/uploads/avatar/defaultavatar.webp') }}" class="" alt="..."
                height="auto" width="75px">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $reply->user->name }}</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Joined: {!! date('d-M-y', strtotime($reply->user->created_at)) !!}</li>
                <li class="list-group-item">Messages: 0</li>
                <li class="list-group-item">Reactions: {{ $reply->user->reactions }}</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-10 col-sm-12" style="overflow: hidden;">
        <div class="card-body">
            <h5 class="card-title">{{ $reply->title }}</h5>
        </div>
        <hr class="m-1">
        <div style="overflow-y: scroll; height: 300px; width: 100%; overflow-x: hidden">
            {!! $reply->description !!}
        </div>

        <div class="child-social">
            <div class="reaction-parent">
                <i onclick="showReactions(this)"
                    class="@if ($reply->isLiked()) bi bi-{{ $reply->reacted()?->type }}@else bi bi-hand-thumbs-up @endif"
                    style="font-size: 1.2rem; cursor: pointer;"></i>
                <a href="#ckreply"
                    onclick="ckreply({{ json_encode($reply->description, 1) }},{{ json_encode($reply->user->name, 1) }})"
                    style="color: #000;">
                    <i class="bi bi-reply" style="font-size: 1.2rem;"></i>
                </a>
            </div>
            <div class="reaction-child" style="display:none;">
                <i wire:click="react('hand-thumbs-up-fill')" class="bi bi-hand-thumbs-up-fill"></i>
                <i wire:click="react('hand-thumbs-down-fill')" class="bi bi-hand-thumbs-down-fill"></i>
                <i wire:click="react('emoji-heart-eyes-fill')" class="bi bi-emoji-heart-eyes-fill"></i>
                <i wire:click="react('emoji-frown-fill')" class="bi bi-emoji-frown-fill"></i>
                <i wire:click="react('heart-fill')" class="bi bi-heart-fill"></i>
            </div>
        </div>
    </div>
</div>
