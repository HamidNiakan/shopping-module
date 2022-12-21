@extends('Dashboard::master')

@section('breadcrumb')
    <li>
        <a href="{{route('role-permission.index')}}" title="دسته بندی">نقشه های کاربری</a>
    </li>
    <li>
        <a href="#" title="ویرایش دسته بندی">ویرایش نقشه کاربر</a>
    </li>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection

@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 bg-white">
            <p class="box__title">ویرایش نقشه کاربر ({{$role->name}})</p>
            <form action="{{route('role-permission.update',$role->id)}}" method="POST" class="padding-30">
                @csrf
                <input type="hidden" name="id"  value="{{$role->id}}">
                <input type="text" name="name" placeholder="عنوان نقشه"  class="text" value="{{old('name',$role->name)}}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    {{$message}}
                </span>
                @enderror
                <p class="box__title margin-bottom-15">انتخاب مجوز ها</p>
                <ul class="list-permission">
                    @foreach($permissions as $permission)
                        <li>
                            <label class="ui-checkbox pt-1">
                                <input type="checkbox" name="permissions[{{$permission->name}}]" class="sub-checkbox" data-id="{{$permission->id}}" value="{{$permission->name}}"
                                       @if($role->hasPermissionTo($permission->name)) checked @endif
                                >
                                <span class="checkmark"></span>
                                @lang($permission->name)
                            </label>
                        </li>
                    @endforeach
                </ul>
                @error('permissions')
                <span class="invalid-feedback" role="alert">
                    {{$message}}
                </span>
                @enderror
                <br>

                <button type="submit" class="btn btn-webamooz_net">اضافه کردن</button>
            </form>
        </div>
    </div>

@endsection