<x-app-layout>
    <x-slot name="title">
        - تغییر پسورد
    </x-slot>
<main class="bg--white">
    <div class="container">
        <div class="sign-page">
            <h1 class="sign-page__title">بازیابی رمز عبور</h1>
            <form class="sign-page__form" action="{{ route('password.email') }}" method="POST">
                @if (count($errors)>0)
                    <div class="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('status'))
                    <div class="alert" style="background: rgb(183, 255, 189); color: rgb(3, 114, 12);">
                        {{Session::get('status')}}
                    </div>
                @endif
                 @csrf
                <input type="text" name="email" class="text text--left" placeholder="ایمیل">
                    <button class="btn btn--blue btn--shadow-blue width-100 ">بازیابی</button>
                    <div class="sign-page__footer">
                        <span>کاربر جدید هستید؟</span>
                        <a href="{{ route('register') }}" class="color--46b2f0">صفحه ثبت نام</a>

                 </div>
            </form>
        </div>
    </div>
</main>
</x-app-layout>
