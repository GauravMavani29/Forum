@push('stylesheets')
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
@endpush
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
