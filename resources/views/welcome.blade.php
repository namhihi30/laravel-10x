<div class="col-12">
    <div class="mb-3 mt-3">
        <div
            class="row @if($errors->has('thumbnail')) align-items-center @else align-items-end @endif   ">
            <div class="col-7">
                <label for="thumbnail" class="form-label mb-0">Ảnh đại diện:</label>
                <input type="text" class="form-control @if($errors->has('thumbnail')) is-invalid @endif"
                       id="thumbnail"
                       placeholder="Enter sale thumbnail" name="thumbnail"
                       value="{{ old('thumbnail') }}">

            </div>
            <div class="col-2">
                <button id="lfm" data-input="thumbnail" data-preview="holder" type="button"
                        class="btn btn-primary">Chọn ảnh
                </button>
            </div>
            <div class="col-3">
                <div id="holder">
                    @if(old('thumbnail'))
                        <img width="150px" src="{{ old('thumbnail') }}" alt="">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<textarea id="my-editor" name="content" class="form-control">{!! old('content', 'test editor content') !!}</textarea>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>

        CKEDITOR.replace('my-editor', options);

    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
