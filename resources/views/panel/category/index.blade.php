<x-panel-layout>
    <x-slot name='title'>
        - دستع بندی ها
    </x-slot>
    <x-slot name='styles'>
        <link rel="stylesheet" href="{{ asset('blog/css/style.css') }}">
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{route('panel')}}">پیشخوان</a></li>
            <li><a href="{{ route('category.index') }}" class="is-active">دسته بندی ها</a></li>
        </ul>
    </div>
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <table class="table bg-white">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>
                            <th>دسته پدر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $item)    
                            <tr role="row" class="">
                                <td><a href="">{{$item->id}}</a></td>
                                <td><a href="">{{$item->name}}</a></td>
                                <td>{{$item->slug}}</td>
                                <td>{{ $item->parentCategoryName() }}</td>
                                <td>
                                    <a href="{{ route('category.destroy', $item->id) }}" onclick="destroyCategory(event, {{ $item->id }})" class="item-delete mlg-15" title="حذف"></a>
                                    <a href="{{ route('category.edit',$item->id) }}" class="item-edit " title="ویرایش"></a>
                                    <form action="{{ route('category.destroy', $item->id) }}" method="POST" id="destroy{{ $item->id }}">
                                      @csrf
                                      @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
            <div class="col-4 bg-white">
                <p class="box__title">ایجاد دسته بندی جدید</p>
                <form action="{{ route('category.store') }}" method="POST" class="padding-30">
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
                      <input name="name" type="text" placeholder="نام دسته بندی" class="text">
                      <input name="slug" type="text" placeholder="نام انگلیسی دسته بندی" class="text">
                      <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                      <select name="category_id" class="select" name="" id="">
                          <option value="">ندارد</option>
                          @foreach ($categories as $item)
                            @if (!$item->category_id)    
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                          @endforeach
                      </select>
                      <button class="btn btn-webamooz_net">اضافه کردن</button>
                  </form>
            </div>
        </div>
    </div>
</div>
<x-slot name="scripts">
    <script>
        function destroyCategory(event, id) {
          event.preventDefault();
          Swal.fire({
                        title: 'آیا میخواهید دسته بندی حذف شود',
                        text: "اگر از حذف پشیمان شده اید کلید لغو برا بفشارید",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'لغو',
                        confirmButtonText: 'حذف'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('destroy' + id).submit();
                        }
                    })
        }
      </script>
</x-slot>
</x-panel-layout>