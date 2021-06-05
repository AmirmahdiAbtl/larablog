
<x-app-layout>
    <x-slot name="title">
        - تغییر پسورد
    </x-slot>
<main class="bg--white">
    <div class="container">
        <div class="sign-page">
            <h1 class="sign-page__title">بازیابی رمز عبور</h1>
            <form class="sign-page__form" action="{{ route('password.update') }}" method="POST">
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
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <input type="text" name="email" class="text text--left" placeholder="ایمیل" value="{{$request->email}}" required autofocus>
                <input type="password" name="password" class="text text--left" placeholder="رمز عبور جدید">
                <input type="password" name="password_confirmation" class="text text--left" placeholder="تایید رمز جدید">
                <button class="btn btn--blue btn--shadow-blue width-100 " style="margin-bottom: 1.5rem;"> بازیابی رمز عبور </button>   
            </form>
        </div>
    </div>
</main>
</x-app-layout>
