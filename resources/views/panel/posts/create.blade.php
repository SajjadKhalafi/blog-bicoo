<x-panel-layout>
    <x-slot name="title">
        - ایجاد مقاله
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('posts.index') }}" class="is-active"> مقالات</a></li>
            <li><a href="{{ route('posts.create') }}" class="is-active">ایجاد مقاله جدید</a></li>
        </ul>
    </div>
    <div class="main-content padding-0">
        <p class="box__title">ایجاد مقاله جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{ route('posts.store') }}" method="POST" class="padding-30"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" class="text" placeholder="عنوان مقاله">
                    @error('title')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <ul class="tags">

                        <li class="addedTag">dsfsdf<span class="tagRemove" onclick="$(this).parent().remove();">x</span>
                            <input type="hidden" value="dsfsdf" name="categories[]"></li>
                        <li class="addedTag">dsfsdf<span class="tagRemove" onclick="$(this).parent().remove();">x</span>
                            <input type="hidden" value="dsfsdf" name="categories[]"></li>
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
                            <input type="file" class="file-upload" id="files" name="banner" accept="image/*" />
                        </div>
                        <span class="filesize"></span>
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    </div>
                    @error('banner')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <textarea placeholder="متن مقاله" class="text" name="content"></textarea>
                    <button type="submit" class="btn btn-webamooz_net">ایجاد مقاله</button>
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
    </x-slot>
</x-panel-layout>
