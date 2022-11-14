<x-panel-layout>
    <x-slot name="title">
        - ویرایش کاربر
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('categories.index') }}" class="is-active">دسته بندی ها</a></li>
            <li><a href="{{ route('categories.edit' , $category->id) }}" class="is-active">ویرایش دسته بندی</a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="row no-gutters bg-white margin-bottom-20">
            <div class="col-12">
                <p class="box__title">ویرایش کاربر</p>
                <form action="{{ route('categories.update' , $category->id) }}" class="padding-30" method="POST">
                    @csrf
                    @method('put')
                    <input type="text" name="name" class="text" placeholder="نام دسته بندی"
                           value="{{ $category->name }}">
                    @error('name')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <select class="select" name="category_id" id="category_id">
                        <option value="">ندارد</option>
                        @foreach($parentCategories as $parentCategory)
                            <option value="{{ $parentCategory->id }}" @if($parentCategory->id === $category->category_id) selected @endif>{{ $parentCategory->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <button type="submit" class="btn btn-webamooz_net">ویرایش</button>
                </form>

            </div>
        </div>
    </div>
</x-panel-layout>
