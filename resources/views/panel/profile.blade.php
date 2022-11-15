<x-panel-layout>
    <x-slot name="title">
        - اطلاعات کاربر
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('profile') }}" class="is-active">اطلاعات کاربری</a></li>
        </ul>
    </div>
    <div class="main-content  ">
        <div class="user-info bg-white padding-30 font-size-13">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="profile__info border cursor-pointer text-center">
                    <div class="avatar__img"><img src="{{ auth()->user()->getProfileUrl() }}" class="avatar___img">
                        <input type="file" name="profile" accept="image/*" class="hidden avatar-img__input">
                        <div class="v-dialog__container" style="display: block;"></div>
                        <div class="box__camera default__avatar"></div>
                    </div>
                    <span class="profile__name">کاربر : {{ auth()->user()->name }}</span>
                </div>
                @error('profile')
                <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                    {{ $message }}
                </p>
                @enderror
                <input class="text" name="name" placeholder="نام کاربری" value="{{ auth()->user()->name }}">
                @error('name')
                <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                    {{ $message }}
                </p>
                @enderror
                <input class="text text-left" name="mobile" placeholder="تلفن همراه" value="{{ auth()->user()->mobile }}">
                @error('mobile')
                <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                    {{ $message }}
                </p>
                @enderror
                <input class="text text-left" type="email" name="email" placeholder="ایمیل" value="{{ auth()->user()->email }}">
                @error('email')
                <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                    {{ $message }}
                </p>
                @enderror
                <input class="text text-left" type="password" name="password" placeholder="رمز عبور">
                @error('password')
                <p style="color: #D8000C;text-align: right;margin-bottom: 1rem;">
                    {{ $message }}
                </p>
                @enderror
                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&*()</strong> باشد.</p>
                <br>
                <br>
                <button type="submit" class="btn btn-webamooz_net">ذخیره تغییرات</button>
            </form>
        </div>

    </div>
</x-panel-layout>
