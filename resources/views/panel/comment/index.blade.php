<x-panel-layout>
    <x-slot name="title">
        - مدیریت نظرات
    </x-slot>
    <x-slot name='styles'>
        <link rel="stylesheet" href="{{ asset('blog/css/style.css') }}">
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('panel') }}">پیشخوان</a></li>
            <li><a href="{{ route('comment.index') }}" class="is-active"> نظرات</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item @if(!request()->has('status')) is-active @endif" href="{{ route('comment.index') }}"> همه نظرات</a>
                <a class="tab__item @if(request()->has('status') && request('status')==0) is-active @endif" name="reject" href="{{ route('comment.index',['status'=>0]) }}">نظرات تاییده نشده</a>
                <a class="tab__item @if(request()->has('status') && request('status')==1) is-active @endif" href="{{ route('comment.index',['status'=>1])}}">نظرات تاییده شده</a>
            </div>
        </div>
        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>ارسال کننده</th>
                    <th>برای</th>
                    <th>دیدگاه</th>
                    <th>تاریخ</th>
                    <th>تعداد پاسخ ها</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($comment as $item)
                        <tr role="row" >
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->post->title }}</td>
                            <td>{{ $item->comment }}</td>
                            <td>{{ $item->getShamsyDate() }}</td>
                            <td>{{ count($item->comments) }}</td>
                            @if($item->status)
                                <td class="text-success">تاییده شده</td>
                            @else
                                <td class="text-error">تاییده نشده</td>
                            @endif
                            <td>
                                <a class="item-delete mlg-15" title="حذف" onclick="commentdeleted({{$item->id}})"></a>
                                @if ($item->status)
                                    <a onclick="updated({{ $item->id }})" class="item-reject mlg-15" title="رد"></a>
                                @else
                                    <a onclick="updated({{ $item->id }})" class="item-confirm mlg-15" title="تایید"></a>
                                @endif
                                <a href="show-comment.html" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <form action="{{ route('comment.delete',$item->id) }}" id="comment{{ $item->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                </form>
                                <form action="{{ route('comment.update',$item->id) }}" id="update{{ $item->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $comment->appends(request()->query())->links() }}
        </div>
    </div>
    <x-slot name="scripts">
        <script>
            function commentdeleted(id){
                Swal.fire({
                        title: 'آیا میخواهید نظرات حذف شود',
                        text: "اگر از حذف پشیمان شده اید کلید لغو برا بفشارید",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'لغو',
                        confirmButtonText: 'حذف'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('comment'+id).submit();
                        }
                    })
            }
            function updated(id){
                document.getElementById('update'+id).submit();
            }
        </script>
    </x-slot>
</x-panel-layout>