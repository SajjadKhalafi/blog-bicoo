<x-panel-layout>
    <x-slot name="title">
        - ویرایش کاربر
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}" >پیشخوان</a></li>
            <li><a href="{{ route('users.index') }}" class="is-active">کاربران</a></li>
            <li><a href="{{ route('users.edit' , $user->id) }}" class="is-active">ویرایش کاربران</a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="row no-gutters bg-white margin-bottom-20">
            <div class="col-12">
                <p class="box__title">ویرایش کاربر</p>
                <form action="{{ route('users.update' , $user->id) }}" class="padding-30" method="POST">
                    @csrf
                    @method('put')
                    <input type="text" name="name" class="text" placeholder="نام و نام خانوادگی" value="{{ $user->name }}">
                    @error('name')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <input type="text" name="email" class="text" placeholder="ایمیل" value="{{ $user->email }}">
                    @error('email')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <input type="text" name="mobile" class="text" placeholder="شماره موبایل" value="{{ $user->mobile }}">
                    @error('mobile')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <select name="role" id="" class="select">
                        <option value="user" @if($user->role === 'user') selected @endif>کاربر عادی</option>
                        <option value="author" @if($user->role === 'author') selected @endif>نویسنده</option>
                        <option value="admin" @if($user->role === 'admin') selected @endif>مدیر</option>
                    </select>
                    @error('role')
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
