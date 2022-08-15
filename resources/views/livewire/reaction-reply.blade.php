@push('stylesheets')
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
@endpush
<div class="container-fluid">
    <div class="row no-gutters border m-1 p-2">
        <div class="col-12 col-md-2 col-sm-12">
            <div class="card" style="width: 100%;">
                <img src="{{ asset('/uploads/avatar/defaultavatar.webp') }}" class="card-img-top" alt="..."
                    height="auto" width="100px">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $thread->user->name }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Joined: {!! date('d-M-y', strtotime($thread->user->created_at)) !!}</li>
                    <li class="list-group-item">Messages: 0</li>
                    <li class="list-group-item">Reactions: {{ count($thread->user->reactions) }}</li>
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
                    @if (count($thread->replies) > 0)
                        @foreach ($thread->replies as $reply)
                            <div class="row mb-2" style="border-left: 1rem solid black;">
                                <div class="col-12 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                                    <img src="{{ asset('/uploads/avatar/defaultavatar.webp') }}" class="card-img-top"
                                        alt="..." style="height: 50px; width: 50px;">
                                </div>
                                <div class="col-12 col-sm-11 col-md-11 col-lg-11 col-xl-11 px-3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $reply->user->name }} said:</h5>
                                        {!! $reply->description !!}
                                        {{-- <small class="text-muted">{{ date('d-M-y', strtotime($reply->created_at)) }}</small> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="card-text">{!! $thread->description !!}</p>
                    @endif
                </div>
                <div class="child-social">
                    <button wire:click="like" class="border-transparent btn btn-light bg-transparent">
                        <i class="{{ $thread->isLiked() ? 'bi bi-hand-thumbs-up-fill' : ' bi bi-hand-thumbs-up' }}"></i>
                        {{-- <span class="font-medium text-gray-900">{{ $count }}</span> --}}
                    </button>
                    <a href="#ckreply" onclick="ckreply()" class="border-transparent btn btn-light bg-transparent">
                        <i class="bi bi-reply"></i>
                    </a>
                </div>
            
        </div>
    </div>
    <div class="row no-gutters border m-1 p-2" id="ckreply" style="display:none;">
        <div class="col-12 col-md-2 col-sm-12">
            <div class="card" style="width: 100%;">
                <img src="{{ asset('/uploads/avatar/defaultavatar.webp') }}" class="card-img-top" alt="..."
                    height="auto" width="100px">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-10 col-sm-12 parent-social">
            <form wire:submit.prevent="replysubmit" wire:ignore>
                <div class="form-group">
                    <label> Reply </label>
                    <textarea wire:model.defer="description" class="form-control" id="description" name="description" ></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary my-2 d-flex justify-content-center align-items-center"> <i
                            class="bi bi-reply" style="margin-bottom: 8px; margin-right: 4px;"></i> Post reply</button>
                </div>
            </form>            
        </div>
    </div>
</div>

@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });

        function ckreply() {
            if ($('#ckreply').css('display') == 'none') {
                $('#ckreply').css('display', '');
            } else {
                $('#ckreply').css('display', 'none');
            }
        }

        window.addEventListener('threadreplysent', function() {
            ckreply();
            document.querySelector('.ck-editor__editable').ckeditorInstance.setData('');
        });
    </script>
@endpush
