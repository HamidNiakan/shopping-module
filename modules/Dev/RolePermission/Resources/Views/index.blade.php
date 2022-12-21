@extends('Dashboard::master')

@section('styles')
@endsection
@section('breadcrumb')
    <li>
        <a href="{{route('role-permission.index')}}" title="نقشه های کاربری">نقشه های کاربری</a>
    </li>
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
                        <th>نقشه های کاربر</th>
                        <th>مجوز ها</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr role="row" class="">
                            <td>
                                <a href="">{{$role->id}}</a>
                            </td>
                            <td>
                                <a href="">{{$role->name}}</a>
                            </td>
                            <td>
                                <ul>
                                    @foreach($role->permissions as $item)
                                        <li>
                                            @lang($item->name)
                                        </li>
                                    @endforeach

                                </ul>
                            </td>
                            <td>
                                <a href="#" onclick="event.preventDefault(); deleteItem(event,'{{route('role-permission.destroy',$role)}}')" class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{route('role-permission.edit',$role->id)}}" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 bg-white">
            @include("RolePermission::create",compact('permissions'))
        </div>
    </div>
@endsection