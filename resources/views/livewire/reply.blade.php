@push('stylesheets')
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script> --}}
    <style>
        blockquote {
            padding-left: 20px;
            padding-right: 8px;
            border-left: 5px solid #ccc;
            font-style: italic;
            font-family: Georgia, Times, "Times New Roman", serif;
            margin: 13px 40px;
        }
    </style>
@endpush
<div class="container-fluid">
    <div class="row no-gutters border m-1 p-2">
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
                    {{-- <li class="list-group-item">Reactions: {{ count($thread->reactions) }}</li> --}}
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-10 col-sm-12 parent-social" style="overflow: hidden;">
            <div class="card-body">
                <h5 class="card-title">{{ $thread->title }}</h5>
            </div>
            <hr>
            <div style="overflow-y: scroll; position: absolute; height: 79%; width: 100%; overflow-x: hidden">
                {!! $thread->description !!}
            </div>
            <div class="child-social">
                <button wire:click="like" class="border-transparent btn btn-light bg-transparent">
                    <i class="{{ 1 ? 'bi bi-hand-thumbs-up-fill' : ' bi bi-hand-thumbs-up' }}"></i>
                    {{-- <span class="font-medium text-gray-900">{{ $count }}</span> --}}
                </button>
                <a href="#ckreply" onclick="ckreply({{ json_encode($thread->description, 1) }},{{ json_encode($thread->user->name, 1) }})" class="border-transparent btn btn-light bg-transparent">
                    <i class="bi bi-reply"></i>
                </a>
            </div>
        </div>
    </div>
    @if (count($thread->replies) > 0)
        @foreach ($thread->replies as $reply)
            <div class="row no-gutters border m-1 p-2">
                <div class="col-12 col-md-2 col-sm-12">
                    <div class="card d-flex justify-content-center align-items-center" style="width: 100%;">
                        <div>
                            <img src="{{ asset('/uploads/avatar/defaultavatar.webp') }}" class="" alt="..."
                                height="75px" width="75px">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $reply->user->name }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Joined: {!! date('d-M-y', strtotime($reply->user->created_at)) !!}</li>
                            <li class="list-group-item">Messages: 0</li>
                            {{-- <li class="list-group-item">Reactions: {{ count($reply->user->reactions) }}</li> --}}
                            <li class="list-group-item">Vestibulum at eros</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-10 col-sm-12 parent-social" style="overflow: hidden;">
                    <div class="card-body">
                        <p class="card-title">{!! date('d-M-y', strtotime($reply->created_at)) !!}</p>
                    </div>
                    <hr>
                    <div style="overflow-y: scroll; position: absolute; height: 75%; width: 100%; overflow-x: hidden">
                        {!! $reply->description !!}
                    </div>
                    <div class="child-social">
                        <button wire:click="like" class="border-transparent btn btn-light bg-transparent">
                            <i
                                class="{{ 1 ? 'bi bi-hand-thumbs-up-fill' : ' bi bi-hand-thumbs-up' }}"></i>
                            {{-- <span class="font-medium text-gray-900">{{ $count }}</span> --}}
                        </button>
                        <a href="#ckreply"
                            onclick="ckreply({{ json_encode($reply->description, 1) }},{{ json_encode($reply->user->name, 1) }})"
                            class="border-transparent btn btn-light bg-transparent">
                            <i class="bi bi-reply"></i>
                        </a>
                    </div>
                </div>
            </div>
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
                            class="bi bi-reply" style="margin-bottom: 8px; margin-right: 4px;"></i> Post reply</button>
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

        function ckreply(description, username) {
            console.log(username)

            ckdata +=
                `<blockquote>${username} said:${description}</blockquote><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>`;
            CKEDITOR.instances.description.setData(ckdata);
            var editor = CKEDITOR.instances[description];
            editor.focus();
        }
    </script>
@endpush
