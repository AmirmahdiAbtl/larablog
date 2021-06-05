<x-panel-layout>
    <x-slot name="title">
        - مدیریت مقالات
    </x-slot>
    <x-slot name='styles'>
        <link rel="stylesheet" href="{{ asset('blog/css/style.css') }}">
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('panel') }}">پیشخوان</a></li>
            <li><a href="{{ route('post.index') }}" class="is-active"> مقالات</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('post.index') }}">لیست مقالات</a>
                <a class="tab__item " href="{{ route('post.create') }}">ایجاد مقاله جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="{{ route('post.index') }} " method="GET">
                    <div class="t-header-searchbox font-size-13">
                        <div type="text" class="text search-input__box font-size-13">جستجوی مقاله
                            <div class="t-header-search-content ">
                                <input name="search" type="text" class="text" placeholder="نام مقاله">
                                <button class="btn btn-webamooz_net">جستجو</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>عنوان</th>
                    <th>نویسنده</th>
                    <th>تاریخ ایجاد</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($post as $item)
                <tr role="row" class="">
                    <td><a href="">{{ $item->id }}</a></td>
                    <td><a href="">{{ $item->title }}</a></td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->getShamsyDate() }}</td>
                    <td>
                        <a class="item-delete mlg-15" title="حذف" onclick="distroyPost({{$item->id}})"></a>
                        <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                        <form style="display: inline" action="{{ route('post.edit',$item->id) }}" method="GET">
                            <button style="display: inline; cursor: pointer;; background-color: transparent" type="submit"><a class="item-edit" title="ویرایش"></a></button>
                        </form>
                        <form action="{{ route('post.destroy', $item->id) }}" method="POST" id="post{{ $item->id }}">
                            @csrf
                            @method('delete')
                          </form>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            {{ $post->appends(request()->query())->links() }}
        </div>
    </div>
    <x-slot name="scripts">
        <script>
            function distroyPost(id){
                Swal.fire({
                        title: 'آیا میخواهید مقاله حذف شود',
                        text: "اگر از حذف پشیمان شده اید کلید لغو برا بفشارید",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'لغو',
                        confirmButtonText: 'حذف'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('post'+id).submit();
                        }
                    })
            }
        </script>
    </x-slot>
</x-panel-layout>