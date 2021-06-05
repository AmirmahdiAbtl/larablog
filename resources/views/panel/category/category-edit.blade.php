<x-panel-layout>
    <x-slot name="title">
        - ویرایش دسته بندی
    </x-slot>
    <div class="breadcrumb">
        <ul>
        <li><a href="{{ route('panel') }}" title="پیشخوان">پیشخوان</a></li>
        <li><a href="{{ route('category.index') }}" class="">دسته بندی ها</a></li>
        <li><a href="{{ route('category.edit',$category->id) }}" class="is-active">ویرایش دسته بندی ها</a></li>
    </ul>
</div>
<div class="main-content font-size-13">
    <div class="row no-gutters bg-white margin-bottom-20">
        <div class="col-12">
            <p class="box__title">ویرایش دسته بندی ها</p>
                <form action="{{ route('category.update',$category) }}" class="padding-30" method="post">
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
                    @method('put')
                    <input name="name" type="text" class="text" placeholder="اسم دسته بندی" value="{{$category->name}}">
                    <input name="slug" type="text" class="text" placeholder="اسم انگلیسی دسته بدی"  value="{{$category->slug}}">
                    <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                      <select name="category_id" class="select" name="" id="">
                          <option value="@if($category->category_id) {{$category->category_id}}  @endif">@if($category->category_id) {{$category->parentCategoryName()}} @else ندارد @endif</option>
                          @foreach ($all as $item)
                            @if (!$item->category_id && $item->id !== $category->id)    
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                          @endforeach
                      </select>
                    <button class="btn btn-webamooz_net" type="submit">ویرایش دسته بندی</button>
                </form>
            </div>
        </div>
    </div>
</x-panel-layout>