@extends('Dashboard::master')

@section('breadcrumb')
    <li>
        <a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a>
    </li>
    <li>
        <a href="#" title="ایجاد دوره">ایجاد دوره</a>
    </li>
@endsection

@section('content')
    <p class="box__title">ایجاد دوره جدید</p>
    <div class="row no-gutters bg-white">
        <div class="col-12">
            <form action="{{route('courses.store')}}" method="POST" class="padding-30" enctype="multipart/form-data">
                @csrf
                <x-input name="title" placeholder="عنوان دوره" type="text"/>
                <x-input name="slug" placeholder="نام انگلیسی دوره" type="text"/>
                <div class="d-flex multi-text">
                    <x-input name="priority" placeholder="ردیف دوره" type="text" class="text-left"/>
                    <x-input name="price" placeholder="مبلغ دوره" type="text" class="text-left"/>
                    <x-input name="teacher_percent" placeholder="درصد مدرس" type="text" class="text-left"/>
                </div>
                <x-select name="teacher_id">
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                    @endforeach
                </x-select>
                <x-select name="type">
                    <option value="" selected>نوع دوره</option>
                    @foreach(\Dev\Course\Models\Course::$types as $item)
                        <option value="{{$item}}">@lang('LangCourses::messages.types.'.$item)</option>
                    @endforeach
                </x-select>
                <x-select name="status">
                    <option value="" selected>وضعیت دوره</option>
                    @foreach(\Dev\Course\Models\Course::$statuses as $item)
                        <option value="{{$item}}">@lang('LangCourses::messages.statuses.'.$item)</option>
                    @endforeach
                </x-select>
                <x-select name="category_id">
                    <option value="" selected>دسته بندی والد</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </x-select>
                <x-select name="">
                    <option value="0">زیر دسته بندی</option>
                    <option value="1">وب</option>
                    <option value="2">ویندوز</option>
                    <option value="3">اندروید</option>
                </x-select>
                <x-file-upload name="image" placeHolder="اپلود بنر دوره" value=""/>
                <x-textarea name="body" placeHolder="توضیحات دوره" value=""/>
                <button type="submit" class="btn btn-webamooz_net">ایجاد دوره</button>
            </form>
        </div>
    </div>
@endsection