<x-app-layout>
<main>
    <article class="container article">
        <div class="articles">
           @foreach ($post as $item)
            <div class="articles__item">
                <a href="{{ route('posts',$item->slug) }}" class="articles__link">
                    <div class="articles__img">
                        <img src="{{ $item->getBannerUrl() }}" class="articles__img-src">
                    </div>
                    <div class="articles__title">
                        <h2>{{ $item->title }}</h2>
                    </div>
                    <div class="articles__details">
                        <div class="articles__author">نویسنده : {{ $item->user->name }}</div>
                        <div class="articles__date">تاریخ : {{ $item->getShamsyDate() }}</div>
                    </div>
                </a>
            </div>
           @endforeach
        </div>
    </article>
    {{-- {{ $post->links() }} --}}
</main>
</x-app-layout>
