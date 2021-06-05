<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>وبلاگ {{$title ?? ""}}</title>
    <meta name="description"
          content="وب آموز وبسایت آموزش برنامه نویسی وب و موبایل ، جاوااسکریپت ، لاراول ، react ، آموزش node js با مجرب ترین مدرسین">
    <meta name="keywords"
          content="آموزش طراحی سایت,آموزش برنامه نویسی,طراحی وب,ساخت وب سایت,آموزش git,آموزش لاراول,آموزش php,آموزش react,آموزش پی اچ پی,آموزش laravel,آموزش جاوا اسکریپت,آموزش ساخت وب سایت,آموزش mvc,آموزش React Native,وب آموز , وب اموز">
    <link rel="canonical" href="https://webamooz.net"/>
    <link rel="stylesheet" href="{{asset('/blog/css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('/blog/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/blog/css/responsive.css')}}" media="(max-width:991px)">
       <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/css/swiper.min.css"> -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body>
<header class="c-header">
    <div class="container container--responsive container--white">
        <div class="c-header__row ">
            <div class="c-header__right">
                <div class="logo">
                    <a href="{{route('index')}}" class="logo__img"></a>
                </div>
                <div class="c-search width-100 ">
                    <form action="{{ route('index') }}" class="c-search__form position-relative">
                        <input name="search" type="text" class="c-search__input" placeholder="جستجو کنید">
                        <button class="c-search__button"><i class="fas fa-bars"></i></button>
                    </form>
                </div>

            </div>
            <div class="c-header__left">
                <div class="c-header__icons">
                    <div class="c-header__button-search "></div>
                    <div class="c-header__button-nav"></div>
                </div>
                @guest
                    <div class="c-button__login-regsiter">
                        <div><a class="c-button__link c-button--login" href="{{route('login')}}">ورود</a></div>
                        <div><a class="c-button__link c-button--register" href="{{route('register')}}">ثبت نام</a></div>
                    </div>   
                @endguest
                @auth
                    <div class="dropdown-select wide" tabindex="0" style="margin-right: 1rem">
                        <span class="current">{{auth()->user()->name}}</span>
                        <div class="list">
                            <ul>
                                <li class="option selected" data-value="0" data-display-text="" tabindex="0">
                                    <a href="{{ route('panel') }}">پروفایل</a>
                                </li>
                                <li class="option logedout" data-value="0" data-display-text="" tabindex="0">خروج
                                </li>
                            </ul>
                            <form action="{{ route('logout') }}" method="POST" class="logoutform">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    <nav class="nav" id="nav">
        @guest
            <div class="c-button__login-regsiter d-none">
                <div><a class="c-button__link c-button--login" href="{{route('login')}}">ورود</a></div>
                <div><a class="c-button__link c-button--register" href="{{route('register')}}">ثبت نام</a></div>
            </div>
        @endguest
        
        <div class="container container--nav">
            <ul class="nav__ul">
                <li class="nav__item"><a href="{{ route('index') }}" class="nav__link">صفحه اصلی</a></li>
                @foreach ($categories as $item)
                    <li class="nav__item @if (count($item->children) > 0) nav__item--has-sub @endif"><a href="{{ route('index',['category'=>$item->slug]) }}" class="nav__link">{{$item->name}}</a>
                       @if (count($item->children) > 0)
                            <div class="nav__sub">
                                <div class="container d-flex item-center flex-wrap container--nav">
                                    @foreach ($item->children as $child)
                                        <a href="{{ route('index',['category'=>$child->slug]) }}" class="nav__link">{{ $child->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                       @endif
                    </li>
                @endforeach
                <li class="nav__item"><a href="{{ route('about') }}" class="nav__link">درباره ما</a></li>
                <li class="nav__item"><a href="#" class="nav__link">تماس باما</a></li>
            </ul>
        </div>
    </nav>
</header>

{{ $slot }}

<footer class="footer">
    <a href="" class="scroll-top"></a>

    <div class="container">
        <div class="footer__links">
            <a href="" class="footer__link">لینک اول</a>
            <a href="" class="footer__link">لینک اول</a>
            <a href="" class="footer__link">لینک اول</a>
            <a href="" class="footer__link">لینک اول</a>
            <a href="" class="footer__link">لینک اول</a>
            <a href="" class="footer__link">لینک اول</a>
        </div>
        <div class="footer__hr"></div>
        <div class="footer__about">
        </div>
    </div>
    <div class="footer__webamooz">
            طراحی و توسعه با لاراول توسط 
        <a class="footer__copy" href="https://google.com"></a>امیرمهدی ابوطالبی</a>
        © 1400
</footer>
<div class="overlay"></div>
{{ $script ?? '' }}
<script src="{{asset('/blog/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('/blog/js/js.js')}}"></script>
<script>
    const dropDown = document.querySelector('.dropdown-select');
    dropDown.addEventListener('click',()=>{dropDown.classList.toggle('open');});
    document.querySelector(".logedout").addEventListener('click',()=>{
        document.querySelector(".logoutform").submit();
    })
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if (session('status'))
    <script>
        Swal.fire({
        icon: 'success',
        title: "{{ session('status') }}"
        })
    </script>
@endif
</body>
</html>