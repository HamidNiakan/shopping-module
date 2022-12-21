<p class="box__title">ایجاد دسته بندی جدید</p>
<form action="{{route('role-permission.store')}}" method="POST" class="padding-30">
    @csrf
    <input type="text" name="name" placeholder="عنوان نقشه" class="text" value="{{old('name')}}">
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
                        @if(is_array(old('$permissions') && array_key_exists($permission->name,old('$permissions')))) checked @endif
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