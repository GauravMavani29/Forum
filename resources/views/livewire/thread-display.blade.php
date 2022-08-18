@push('stylesheets')
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script> --}}
    <style>
        .parent-social {
            position: relative;
        }

        .child-social {
            width: auto !important;
            bottom: 0;
            right: 1rem;
            margin: 1rem 0;
        }

        blockquote {
            padding-left: 20px;
            padding-right: 8px;
            border-left: 5px solid #ccc;
            font-style: italic;
            font-family: Georgia, Times, "Times New Roman", serif;
            margin: 13px 40px;
        }

        .reaction-parent {
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: flex-end;
        }

        .reaction-child {
            width: 135px;
            /* Position the tooltip */
            position: absolute;
            z-index: 1;
            right: 0;
        }

        .reaction-parent i {
            margin-right: 0.5rem;
        }

        .reaction-child .bi {
            font-size: 1.5rem;
        }
    </style>
@endpush
<div class="container-fluid">
    <div class="row no-gutters border m-1 p-2  parent-social">
        <div class="col-12 col-md-2 col-sm-12">
            <div class="card d-flex justify-content-center align-items-center" style="width: 100%;">
                <img src="{{ asset('/uploads/avatar/defaultavatar.webp') }}" class="" alt="..." height="auto"
                    width="75px">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $thread->user->name }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Joined: {!! date('d-M-y', strtotime($thread->user->created_at)) !!}</li>
                    <li class="list-group-item">Messages: 0</li>
                    <li class="list-group-item">Reactions: {{ $thread->user->reactions }}</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-10 col-sm-12" style="overflow: hidden;">
            <div class="card-body">
                <h5 class="card-title">{{ $thread->title }}</h5>
            </div>
            <hr class="m-1">
            <div style="overflow-y: scroll; height: 300px; width: 100%; overflow-x: hidden">
                {!! $thread->description !!}
            </div>

            <div class="child-social">
                <div class="reaction-parent">
                    <i onclick="showReactions(this)"
                        class="@if ($thread->isLiked()) bi bi-{{ $thread->reacted()?->type }}@else bi bi-hand-thumbs-up @endif"
                        style="font-size: 1.2rem; cursor: pointer;" id="reaction"></i>
                    <a href="#ckreply"
                        onclick="ckreply({{ json_encode($thread->description, 1) }},{{ json_encode($thread->user->name, 1) }})"
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
    @if (count($thread->replies) > 0)
        @foreach ($thread->replies as $reply)
            <livewire:thread-reply :reply="$reply"  :key="time() . rand(0, 999)"/>
        @endforeach
    @else
    @endif

    <div class="row no-gutters border m-1 p-2" id="ckreply" wire:ignore>
        <div class="col-12 col-md-2 col-sm-12">
            <div class="card  d-flex justify-content-center align-items-center" style="width: 100%;">
                <img src="{{ asset('/uploads/avatar/defaultavatar.webp') }}" class="" alt="..."
                    height="75px" width="75px">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-10 col-sm-12 parent-social">
            <form wire:submit.prevent="replysubmit">
                <div class="form-group">
                    <label> Reply </label>
                    <textarea wire:model.defer="description" class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary my-2 d-flex justify-content-center align-items-center"> <i
                            class="bi bi-reply" style="margin-bottom: 8px; margin-right: 4px;"></i> Post
                        reply</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
    <script>
        var ckdata = "";
        var editor = CKEDITOR.replace('description');

        // The "change" event is fired whenever a change is made in the editor.
        editor.on('change', function(event) {
            console.log(event.editor.getData())
            @this.set('description', event.editor.getData());
            ckdata = event.editor.getData();
        })


        window.addEventListener('threadreplysent', function() {
            CKEDITOR.instances.description.setData('');
            ckdata = "";
        });

        window.addEventListener('replyreaction', function() {
            window.livewire.emit('update-thread');
            
        });

        function ckreply(description, username) {
            console.log(username)

            ckdata +=
                `<blockquote>${username} said:${description}</blockquote><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>`;
            CKEDITOR.instances.description.setData(ckdata);
            var editor = CKEDITOR.instances[description];
            editor.focus();
        }

        function showReactions(ele) {
            if(ele.parentNode.nextElementSibling.style.display == "none") {
                ele.parentNode.nextElementSibling.style.display = "block";
            } else {
                ele.parentNode.nextElementSibling.style.display = "none";
            }
            // $('.reaction-child').toggle();
        }

    </script>
@endpush
