<x-app-layout>
    <x-slot name="title">
        - ثبت نام
    </x-slot>
    <main class="bg--white">
        <div class="container">
            <div class="sign-page">
                <h1 class="sign-page__title">ثبت نام در وب‌سایت</h1>

                <form class="sign-page__form">
                    <form action="{{ route('register.store') }}" method="post">
                        @csrf
                        <input type="text" name="name" class="text text--right" placeholder="نام  و نام خانوادگی" />
                        @error('name')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                        <input type="text" name="mobile" class="text text--left" placeholder="شماره موبایل" />
                        @error('mobile')
                        <p style="color: red">{{ $message }}</p>
                        @enderror
                        <input type="email" name="email" class="text text--left" placeholder="ایمیل" />
                        @error('email')
                        <p style="color: red">{{ $message }}</p>
                        @enderror
                        <input type="password" name="password" class="text text--left" placeholder="رمز عبور" />
                        @error('password')
                        <p style="color: red">{{ $message }}</p>
                        @enderror
                        <input type="password" name="password_confirmation" class="text text--left" placeholder="تکرار رمز عبور" />


                        <button type="submit" class="btn btn--blue btn--shadow-blue width-100 mb-10">ثبت نام</button>
{{--                        <button type="reset" class="btn btn--red btn--shadow-red width-100 ">ثبت نام</button>--}}
                        <div class="sign-page__footer">
                            <span>در سایت عضوید ؟ </span>
                            <a href="{{ route('login') }}" class="color--46b2f0">صفحه ورود</a>

                        </div>
                    </form>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>
