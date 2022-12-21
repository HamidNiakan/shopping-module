@extends('Dashboard::master')

@section('breadcrumb')
    <li>
        <a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a>
    </li>
    <li>
        <a href="#" title="ویرایش دوره">ویرایش دوره</a>
    </li>
@endsection

@section('content')
    <p class="box__title">ویرایش دوره </p>
    <div class="row no-gutters bg-white">
        <div class="col-12">
            <form action="{{route('courses.update',$course->id)}}" method="POST" class="padding-30" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <x-input name="title" value="{{$course->title}}" placeholder="عنوان دوره" type="text"/>
                <x-input name="slug" value="{{$course->slug}}"  placeholder="نام انگلیسی دوره" type="text"/>
                <div class="d-flex multi-text">
                    <x-input name="priority" value="{{$course->priority}}"  placeholder="ردیف دوره" type="text" class="text-left"/>
                    <x-input name="price" value="{{$course->price}}" placeholder="مبلغ دوره" type="text" class="text-left"/>
                    <x-input name="teacher_percent" value="{{$course->teacher_percent}}" placeholder="درصد مدرس" type="text" class="text-left"/>
                </div>
                <x-select name="teacher_id">
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}" @if($teacher->id == $course->teacher_id) selected @endif>{{$teacher->name}}</option>
                    @endforeach
                </x-select>
                <x-select name="type">
                    <option value="" selected>نوع دوره</option>
                    @foreach(\Dev\Course\Models\Course::$types as $item)
                        <option value="{{$item}}" @if($item == $course->type) selected @endif >@lang('LangCourses::messages.types.'.$item)</option>
                    @endforeach
                </x-select>
                <x-select name="status">
                    <option value="" selected>وضعیت دوره</option>
                    @foreach(\Dev\Course\Models\Course::$statuses as $item)
                        <option value="{{$item}}" @if($item == $course->status) selected @endif>@lang('LangCourses::messages.statuses.'.$item)</option>
                    @endforeach
                </x-select>
                <x-select name="category_id">
                    <option value="" selected>دسته بندی والد</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($category->id == $course->category_id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </x-select>
                <x-select name="">
                    <option value="0">زیر دسته بندی</option>
                    <option value="1">وب</option>
                    <option value="2">ویندوز</option>
                    <option value="3">اندروید</option>
                </x-select>
                <x-file-upload name="image" placeHolder="اپلود بنر دوره" value="{{$course->banner->thumb}}" />
                <x-textarea name="body"  placeHolder="توضیحات دوره" value="{{$course->body}}"/>
                <button type="submit" class="btn btn-webamooz_net">ویرایش دوره</button>
            </form>
        </div>
    </div>
@endsection