<x-app-layout>
    <main>
        <div class="container article">
            <article class="single-page">
                <div class="single-page__title">
                    <h1 class="single-page__h1">{{ $post->title }}</h1>
                    <span class="single-page__like"></span>
                </div>
                <div class="single-page__details">
                    <div class="single-page__author">نویسنده : {{ $post->user->name }}</div>
                    <div class="single-page__date">تاریخ : {{ $post->getShamsyDate() }}</div>
                </div>
                <div class="single-page__img">
                    <img class="single-page__img-src" src="{{ $post->getBannerUrl() }}" alt="">
                </div>
                <div class="single-page__content">
                    <p class="single-page__txt">
                       {!! $post->content !!}
                    </p>
                </div>
                <div class="single-page__tags">
                    <ul class="single-page__tags-ul">
                        @foreach ($post->category as $item)
                            <li class="single-page__tags-li"><a href="{{ route('index',['category'=>$item->slug]) }}" class="single-page__tags-link">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
    
            </article>
        </div>
        <div class="container">
        @auth
            <div class="comments" id="comments">
                <div class="comments__send">
                    <div class="comments__title">
                        <h3 class="comments__h3"> دیدگاه خود را بنویسید </h3>
                        <span class="comments__count">  نظرات ( {{$post->comment_count}} ) </span>
                    </div>
                    <form action="{{ route('comment.store') }}" method="POST" id="comment-form">
                        @csrf
                        <input type="hidden" value="{{ $post->id }}" name="post_id">
                        <input id="comment-id" type="hidden" value="" name="comment_id">
                        <textarea name="comment" class="comments__textarea" placeholder="بنویسید"></textarea>
                        <button type="submit" class="btn btn--blue btn--shadow-blue">ارسال نظر</button>
                        <button onclick="removeRiplay(event)" class="btn btn--red btn--shadow-red">انصراف</button>
                    </form>
                </div>
                <div class="comments__list">
                    @foreach ($comment as $item)
                        @if ($item->status)
                            @include('comment',['comment'=>$item])
                        @endif
                    @endforeach
                </div>
            </div>
            @endauth
            @guest
            <h1 style="padding-bottom: 20px">برای دیدن نظرات و ثبت نظر ابتدا در سایت <a href="{{ route('login') }}" style="color: rgb(100, 206, 255)">ورود</a> یا <a href="{{ route('register') }}" style="color: rgb(100, 206, 255)">ثبت نام</a> نمایید</h1>
            @endguest
        </div>
        </main>
    <x-slot name="script">
        <script>
            function commentid($id){
                document.getElementById("comment-id").setAttribute('value',$id);
                let form = document.getElementById('comment-form');
                console.log(form.children.length);
                if(form.children.length < 7){
                    let replayAlert = document.createElement('div');
                    replayAlert.setAttribute('class','alert')
                    let replayParagraph = document.createTextNode('شما پیامی را پاسخ میدهید');
                    replayAlert.appendChild(replayParagraph);
                    form.appendChild(replayAlert);
                }
            }
            function removeRiplay(){
                event.preventDefault();
                document.getElementById("comment-id").setAttribute('value','');
                let form = document.getElementById('comment-form');
                let form_children = form.childNodes;
                let formlen = form.children.length;
                form.removeChild(form.childNodes[13]);
            }
        </script>
    </x-slot>
</x-app-layout>
