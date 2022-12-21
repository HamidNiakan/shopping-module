@extends('Dashboard::master')

@section('breadcrumb')
    <li>
        <a href="{{route('category.index')}}" title="دسته بندی">دسته بندی</a>
    </li>
    <li>
        <a href="#" title="ویرایش دسته بندی">ویرایش دسته بندی</a>
    </li>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection

@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 bg-white">
            <p class="box__title">ویرایش دسته بندی ({{$category->name}})</p>
            <form action="{{route('category.update', $category->id)}}" method="POST" class="padding-30">
                @csrf
                <input type="text" name="name" value="{{old('name',$category->name)}}" placeholder="نام دسته بندی" class="text">
                @error('name')
                {{$message}}
                @enderror
                <input type="text" name="slug" value="{{old('slug',$category->slug)}}" placeholder="نام انگلیسی دسته بندی" class="text">
                @error('slug')
                {{$message}}
                @enderror
                <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                <select id="" name="parent_id">
                    <option value="">ندارد</option>
                    @foreach($categories as $categoryItem)
                        <option {{$category->parent_id == $categoryItem->id ? 'selected' : ''}} value="{{$categoryItem->id}}">{{$categoryItem->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-webamooz_net">ویرایش کردن</button>
            </form>
        </div>
    </div>

@endsection