<x-panel-layout>
    <x-slot name="title">
        - ساخت کاربر
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}" >پیشخوان</a></li>
            <li><a href="{{ route('users.index') }}" class="is-active">کاربران</a></li>
            <li><a href="{{ route('users.create') }}" class="is-active">ایجاد کاربر جدید</a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="row no-gutters  bg-white">
            <div class="col-12">
                <p class="box__title">ایجاد کاربر</p>
                <form action="{{ route('users.store') }}" class="padding-30" method="POST">
                    @csrf
                    <input type="text" name="name" class="text" placeholder="نام و نام خانوادگی">
                    @error('name')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <input type="text" name="email" class="text" placeholder="ایمیل">
                    @error('email')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <input type="text" name="mobile" class="text" placeholder="شماره موبایل">
                    @error('mobile')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <select name="role" id="" class="select">
                        <option value="">انتخاب نقش</option>
                        <option value="user">کاربر عادی</option>
                        <option value="author">نویسنده</option>
                        <option value="admin">مدیر</option>
                    </select>
                    @error('role')
                    <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                        {{ $message }}
                    </p>
                    @enderror
                    <button type="submit" class="btn btn-webamooz_net">ایجاد کاربر</button>
                </form>

            </div>
        </div>
    </div>
</x-panel-layout>
