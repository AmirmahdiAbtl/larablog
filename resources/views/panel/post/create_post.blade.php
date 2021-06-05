<x-panel-layout>
    <x-slot name="title">
        - ایجاد مقاله
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('panel') }}">پیشخوان</a></li>
            <li><a href="{{ route('post.index') }}"> مقالات</a></li>
            <li><a href="{{ route('post.create') }}"  class="is-active" >ایجاد مقاله جدید</a></li>
        </ul>
    </div>
    <div class="main-content padding-0">
        <p class="box__title">ایجاد مقاله جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{ route('post.store') }}" class="padding-30" method="POST" enctype="multipart/form-data">
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
                    <input name="title" type="text" class="text" placeholder="عنوان مقاله">

                    <ul class="tags">
                       <p>دسته بندی های مربوطه</p>
                        <li class="tagAdd taglist">
                            <input type="text" id="search-field">
                        </li>
                    </ul>

                    <div class="file-upload">
                        <div class="i-file-upload">
                            <span>آپلود بنر دوره</span>
                            <input name="banner" type="file" class="file-upload" id="files" name="files" accept="image/*"/>
                        </div>
                        <span class="filesize"></span>
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    </div>
                    <textarea placeholder="متن مقاله" class="text " name="content"></textarea>
                    <button class="btn btn-webamooz_net">ایجاد مقاله</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="{{asset('blog/panel/js/tagsInput.js')}}"></script>
        <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('content',{
                language:'fa',
                filebrowserUploadUrl: '{{ route("editor-upload",["_token"=>csrf_token()]) }}',
                filebrowserUploadMethod: 'form'
            });
        </script>
    </x-slot>
</x-panel-layout>