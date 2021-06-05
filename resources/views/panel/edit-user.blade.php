<x-panel-layout>
    <x-slot name="title">
        - ویرایش کاربر
    </x-slot>
    <div class="breadcrumb">
        <ul>
        <li><a href="index.html" title="پیشخوان">پیشخوان</a></li>
        <li><a href="users.html" class="">کاربران</a></li>
        <li><a href="users.html" class="is-active">ویرایش کاربران</a></li>
    </ul>
</div>
<div class="main-content font-size-13">
    <div class="row no-gutters bg-white margin-bottom-20">
        <div class="col-12">
            <p class="box__title">ویرایش کاربر</p>
                <form action="{{ route('user.update',$user) }}" class="padding-30" method="post">
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
                    @method('put')
                    <input name="name" type="text" class="text" placeholder="نام و نام خانوادگی" value="{{$user->name}}">
                    <input name="email" type="text" class="text" placeholder="ایمیل"  value="{{$user->email}}">
                    <input name="mobile" type="text" class="text" placeholder="شماره موبایل"  value="{{$user->mobile}}">
                    <select class="select" name="role" value="{{$user->role}}" id="">
                        <option value="{{$user->role}}">{{$user->rolesToPersian()}}</option>
                        <option value="user">کاربر عادی</option>
                        <option value="author">مدرس</option>
                        <option value="admin">مدیر</option>
                    </select>
                    <button class="btn btn-webamooz_net" type="submit">ویرایش کاربر</button>
                </form>
            
        </div>
    </div>
</x-panel-layout>