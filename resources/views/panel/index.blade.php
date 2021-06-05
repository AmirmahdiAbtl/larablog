<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    {{$styles ?? ''}}
    <title>پنل {{ $title ?? '' }}</title>
    <link rel="stylesheet" href="{{ asset('blog/panel/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/responsive_991.css') }}" media="(max-width:991px)">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/responsive_768.css') }}" media="(max-width:768px)">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/font.css') }}">
</head>
<body>
<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="{{ route('index') }}"></a>
    <div class="profile__info border cursor-pointer text-center">
        <div class="avatar__img"><img src="{{ auth()->user()->getProfileImage() }}" class="avatar___img">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                <input type="file" accept="image/*" class="hidden avatar-img__input">
            </form>
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name">کاربر : {{auth()->user()->name}}</span>
        <span class="profile__name">نقش : {{auth()->user()->rolesToPersian()}}</span>
    </div>

   @include('panel.panel-sidebar')

</div>
<div class="content">
    <div class="header d-flex item-center bg-white width-100 border-bottom padding-12-30">
        <div class="header__right d-flex flex-grow-1 item-center">
            <span class="bars"></span>
            <a style="font-size: 2rem" class="header__logo" href="{{ route('index') }}"><span style="color: rgb(9, 136, 175)">Lara</span>Blog</a>
        </div>
        <div class="header__left d-flex flex-end item-center margin-top-2">
            <a href="{{ route('logout') }}" class="logout" title="خروج" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
            <form action="{{ route('logout') }}" method="post" id="logout-form">
              @csrf
            </form>
        </div>
    </div>
    {{ $slot }}
</div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if (session('status'))
    <script>
        Swal.fire({
        icon: 'success',
        title: "{{ session('status') }}"
        })
    </script>
@endif
<script src="{{ asset('blog/panel/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('blog/panel/js/js.js') }}"></script>
{{$scripts ?? ''}}
</html>