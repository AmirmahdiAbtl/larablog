<x-panel-layout>
    <x-slot name='title'>
        - کاربرها
    </x-slot>
    <x-slot name='styles'>
        <link rel="stylesheet" href="{{ asset('blog/css/style.css') }}">
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{route('panel')}}" title="پیشخوان">پیشخوان</a></li>
            <li><a href="{{route('user.index')}}" class="">کاربران</a></li>
        </ul>
    </div>
        <div class="main-content font-size-13">
            <div class="tab__box">
                <div class="tab__items">
                    <a class="tab__item is-active" href="{{ route('user.index') }}">همه کاربران</a>
                    <a class="tab__item" href="{{ route('user.create') }}">ایجاد کاربر جدید</a>
                </div>
            </div>
            <div class="d-flex flex-space-between item-center flex-wrap border-radius-3 bg-white">
            </div>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام و نام خانوادگی</th>
                        <th>شماره همراه</th>
                        <th>ایمیل</th>
                        <th>سطح کاربری</th>
                        <th>وضعیت حساب</th>
                        <th>عملیات</th>
                        <th>تاریخ عضویت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($user as $item)
                        <tr role="row" class="">
                            <td><a href="">{{$item->id}}</a></td>
                            <td><a href="">{{$item->name}}</a></td>
                            <td><a href="">{{$item->mobile}}</a></td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->rolesToPersian()}}</td>
                            @if ($item->state)
                                <td class="text-success">تایید شده</td>
                            @else
                                <td class="text-error">تایید نشده</td>
                            @endif
                            <td>
                                @if(auth()->user()->id !== $item->id && $item->role !== 'admin')
                                    <a href="{{ route('user.destroy',$item->id) }}" class="item-delete mlg-15" title="حذف" style="cursor: pointer;" onclick="destroy(event,{{$item->id}})"></a>
                                    <form action="{{ route('user.destroy',$item->id) }}" method="POST" style="display: inline;" class="deleted-form" id="destroy{{$item->id}}">
                                        @csrf
                                        @method('delete')
                                        {{-- <button style="display: inline; background: transparent; border-color:transparent; cursor: pointer;"></button> --}}
                                    </form>
                                @endif
                                <form action="{{ route('accept',$item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button style="display: inline; background: transparent; border-color:transparent; cursor: pointer;" @if($item->state) disabled @endif><a class="item-confirm mlg-15" title="تایید"></a></a></button>
                                </form>
                                <form action="{{ route('reject',$item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button style="display: inline; background: transparent; border-color:transparent; cursor: pointer;" @if(!$item->state) disabled @endif><a class="item-reject mlg-15" title="رد"></a></button>
                                </form>
                                {{-- <a href="edit-user.html" target="_blank" class="item-eye mlg-15" title="مشاهده"></a> --}}
                                <form action="{{ route('user.edit',$item->id) }}" method="GET" style="display: inline;">
                                    @csrf
                                    <button style="display: inline; background: transparent; border-color:transparent; cursor: pointer;"><a class="item-edit " title="ویرایش"></a></button>
                                </form>
                            </td>
                            <td>{{$item->getShamsyDate()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $user->links() }}
            </div>
        </div>
        <x-slot name="scripts">
            <script>
                function destroy(event,id){
                    event.preventDefault();
                    Swal.fire({
                        title: 'آیا میخواهید کاربر حذف شود',
                        text: "اگر از حذف پشیمان شده اید کلید لغو برا بفشارید",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'لغو',
                        confirmButtonText: 'حذف'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('destroy'+id).submit();
                        }
                    })
                }
            </script>
        </x-slot>
</x-panel-layout>