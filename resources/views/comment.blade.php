
<div id="comment-{{ $comment->id }}">
    <div class="comments__box">
        <div class="comments__inner">
            <div class="comments__header">
                <div class="comments__row">
                    <div class="d-flex flex-grow-1">
                        <div class="comments__avatar">
                            <img src="{{ $comment->user->getProfileImage() }}" class="comments__img">
                        </div>
                        <div class="comments__details">
                            <h5 class="comments__author"><span class="comments__author-name">{{ $comment->user->name }}</span></h5>
                            <span class="comments_date"> {{ $comment->created_at }} </span>
                        </div>
                    </div>
                    <a href="#comments" onclick="commentid({{ $comment->id }})" class="btn btn--blue btn--shadow-blue btn--comments-reply">ارسال پاسخ</a>
                </div>
            </div>
            <p class="comments__body">
                {{ $comment->comment }}
            </p>
        </div>
    </div>
</div>
@if($comment->comments->count() > 0)
<div class="comments__subset">
        @foreach ($comment->comments as $item)
                @include('comment',['comment'=>$item])
        @endforeach
    </div>
@endif
