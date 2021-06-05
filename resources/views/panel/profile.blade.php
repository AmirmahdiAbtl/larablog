<x-panel-layout>
    <x-slot name='title'>
        -اطلاعات کاربری
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('panel') }}">پیشخوان</a></li>
            <li><a href="{{ route('profile.index') }}" class="is-active">اطلاعات کاربری</a></li>
          </ul>
    </div>
    <div class="main-content  ">
        <div class="user-info bg-white padding-30 font-size-13">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
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
                <div class="profile__info border cursor-pointer text-center">
                    <div class="avatar__img"><img src="{{ auth()->user()->getProfileImage() }}" class="avatar___img">
                        <input name="profile" type="file" accept="image/*" class="hidden avatar-img__input">
                        <div class="v-dialog__container" style="display: block;"></div>
                        <div class="box__camera default__avatar"></div>
                    </div>
                    <span class="profile__name">کاربر : {{ auth()->user()->name }}</span>
                </div>
                <input type="test" name="name" class="text" placeholder="نام کاربری" value="{{ auth()->user()->name }}">
                <input type="email" name="email" class="text text-left" placeholder="ایمیل" value="{{ auth()->user()->email }}">
                <input type="text" name="mobile" class="text text-left" placeholder="شماره همراه" value="{{ auth()->user()->mobile }}">
                <input type="password" name="password" class="text text-left" placeholder="رمز عبور">
                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&*()</strong> باشد.</p>
                <br>
                <br>
                <button class="btn btn-webamooz_net">ذخیره تغییرات</button>
            </form>
        </div>

    </div>
</x-panel-layout>