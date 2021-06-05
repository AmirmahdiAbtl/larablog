<ul>
    <li class="item-li i-dashboard @if(request()->is('dashbord')) is-active @endif"><a href="{{route('panel')}}">پیشخوان</a></li>
    @if (auth()->user()->role === 'admin')
        <li class="item-li i-users @if(request()->is('panel/user')||request()->is('panel/user/*')) is-active @endif"><a href="{{ route('user.index') }}"> کاربران</a></li>
        <li class="item-li i-categories @if(request()->is('panel/category')||request()->is('panel/category/*')) is-active @endif"><a href="{{ route('category.index') }}">دسته بندی ها</a></li>
        <li class="item-li i-articles @if(request()->is('panel/post')||request()->is('panel/post/*')) is-active @endif"><a href="{{ route('post.index') }}">مقالات</a></li>
    @endif
    @if (auth()->user()->role == 'author')
        <li class="item-li i-articles @if(request()->is('panel/post')||request()->is('panel/post/*')) is-active @endif"><a href="{{ route('post.index') }}">مقالات</a></li>
    @endif
    @if (auth()->user()->role == 'admin')
        <li class="item-li i-comments @if(request()->is('panel/comment')||request()->is('panel/comment/*')) is-active @endif"><a href="{{ route('comment.index') }}">نظرات</a></li>
    @endif
    <li class="item-li i-user__inforamtion @if(request()->is('panel/profile')) is-active @endif"><a href="{{ route('profile.index') }}">اطلاعات کاربری</a></li>
</ul>