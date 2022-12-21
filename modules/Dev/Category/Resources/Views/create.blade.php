<p class="box__title">ایجاد دسته بندی جدید</p>
<form action="{{route('category.store')}}" method="POST" class="padding-30">
    @csrf
    <input type="text" name="name" placeholder="نام دسته بندی" class="text">
    @error('name')
        {{$message}}
    @enderror
    <input type="text" name="slug" placeholder="نام انگلیسی دسته بندی" class="text">
    @error('slug')
    {{$message}}
    @enderror
    <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
    <select  id="" name="parent_id">
        <option value="">ندارد</option>
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-webamooz_net">اضافه کردن</button>
</form>