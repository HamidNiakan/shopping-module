@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="{{route('category.index')}}" title="دسته بندی">دسته بندی</a></li>
@endsection
@section('styles')
@endsection

@section('scripts')
    <script>
        function deleteItem(event, route) {
            if (confirm('آیا از حذف این آیتم مطمین هستید؟')) {
                $.post(route, {
                    _method: "delete",
                    _token: '{{csrf_token()}}'
                })
                    .done(function (response) {
                        event.target.closest('tr').remove();
                        $.toast({
                            heading: 'Success',
                            text: response.message,
                            showHideTransition: 'slide',
                            position: 'top-left',
                            icon: 'success'
                        })
                    })
                    .fail(function (response) {

                    });
            }
        }
    </script>
@endsection

@section('content')
    <div class="row no-gutters">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">دسته بندی ها</p>
            <div class="table__box">
                <table class="table">
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
                    @foreach($categories as $category)
                        <tr role="row" class="">
                            <td>
                                <a href="">{{$category->id}}</a>
                            </td>
                            <td>
                                <a href="">{{$category->name}}</a>
                            </td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->parent}}</td>
                            <td>
                                <a href="#" onclick="event.preventDefault(); deleteItem(event,'{{route('category.destroy',$category)}}')" class="item-delete mlg-15" title="حذف"></a>
                                <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <a href="{{route('category.edit',$category->id)}}" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 bg-white">
            @include("Category::create",['categories' => $categories, 'category' => @$category])
        </div>
    </div>

@endsection