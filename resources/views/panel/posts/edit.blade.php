<x-panel-layout>
    <x-slot name="title">
        - ویرایش مقاله
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('posts.index') }}" class="is-active"> مقالات</a></li>
            <li><a href="{{ route('posts.edit' , $post->id) }}" class="is-active">ویرایش مقاله</a></li>
        </ul>
    </div>
    <div class="main-content padding-0">
        <p class="box__title">ویرایش مقاله</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{ route('posts.update' , $post->id) }}" method="POST" class="padding-30"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="title" class="text" placeholder="عنوان مقاله" value="{{ $post->title }}">
                    @error('title')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <ul class="tags">
                        @foreach($post->categories as $category)
                            <li class="addedTag">{{ $category->name }}<span class="tagRemove"
                                                             onclick="$(this).parent().remove();">x</span>
                                <input type="hidden" value="{{ $category->name }}" name="categories[]"></li>
                        @endforeach
                        <li class="tagAdd taglist">
                            <input type="text" id="search-field">
                        </li>
                    </ul>
                    @error('categories')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror

                    <div class="file-upload">
                        <div class="i-file-upload">
                            <span>آپلود بنر دوره</span>
                            <input type="file" class="file-upload" id="files" name="banner" accept="image/*" onchange="loadFile(event)" />
                        </div>
                        <span class="filesize"></span>
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    </div>
                    @error('banner')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <p><img id="output" width="200" /></p>
                    <textarea placeholder="متن مقاله" class="text" name="content">{!! $post->content !!}</textarea>
                    <button type="submit" class="btn btn-webamooz_net">ویرایش</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('content', {
                language: 'fa',
                filebrowserUploadUrl: '{{ route("editor-upload", ["_token" => csrf_token()]) }}',
                filebrowserUploadMethod: 'form'
            })
        </script>
        <script src="{{ asset('blog/panel/js/tagsInput.js') }}"></script>
        <script>
            var loadFile = function(event) {
                var image = document.getElementById('output');
                image.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>
    </x-slot>
</x-panel-layout>
