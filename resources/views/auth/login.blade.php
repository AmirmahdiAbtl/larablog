<x-app-layout>
    <x-slot name="title">
        - صفحه ورود
    </x-slot>
    <main class="bg--white">
        <div class="container">
            <div class="sign-page">
                <h1 class="sign-page__title">ورود به وب‌سایت</h1>
                <form class="sign-page__form" action="{{ route('login.store') }}" method="POST">
                    @if (count($errors)>0)
                        <div class="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <input type="text" name="email" class="text text--left" placeholder="شماره یا ایمیل">
                    <input type="password" name="password" class="text text--left" placeholder="رمز عبور">
                    <label class="checkbox text--right">
                        <input type="checkbox" name="remember" class="checkbox__filter">
                        <span class="checkbox__mark position-relative"></span>
                        مرا بخاطر بسپار
                    </label>
                    <a class="recover-password" href="{{ route('password.request') }}">بازیابی رمز عبور</a>
                    <button class="btn btn--blue btn--shadow-blue width-100" type="submit">ورود به سایت</button>
                    <div class="sign-page__footer">
                        <span>کاربر جدید هستید؟</span>
                        <a href="{{ route('register') }}" class="color--46b2f0">صفحه ثبت نام</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    </x-app-layout>