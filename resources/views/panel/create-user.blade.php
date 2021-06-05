<x-panel-layout>
    <x-slot name="title">
        ایجاد کاربر جدید
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{route('panel')}}" title="پیشخوان">پیشخوان</a></li>
            <li><a href="{{route('user.index')}}" class="">کاربران</a></li>
            <li><a href="{{route('user.create')}}" class="is-active">ایجاد کاربر جدید</a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="row no-gutters  bg-white">
            <div class="col-12">
                <p class="box__title">ایجاد کاربر جدید</p>
                <form action="{{ route('user.store') }}" class="padding-30" method="post">
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
                    <input name='email' type="text" class="text" placeholder="ایمیل">
                    <input name='name' type="text" class="text" placeholder="نام و نام خانوادگی">
                    <input name='mobile' type="text" class="text" placeholder="شماره موبایل">
                    <input name='password' type="password" class="text" placeholder="رمز عبور">
                    <select class="select" name="role" id="">
                        <option value="user">کاربر عادی</option>
                        <option value="author">نویسنده</option>
                        <option value="admin">مدیر</option>
                    </select>
                    <button class="btn btn-webamooz_net">افزودن</button>
                </form>

            </div>
        </div>
    </div>
</x-panel-layout>