@extends('Dashboard::master')

@section('breadcrumb')
    <li>
        <a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a>
    </li>
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

        function updateConfirmationStatus(event, route,message, status, field = 'confirmation_status') {
            if (confirm(message)) {
                $.post(route, {
                    _method: "PATCH",
                    _token: '{{csrf_token()}}'
                })
                    .done(function (response) {
                        $(event.target).closest('tr').find('td.' + field).text(status);
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
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">دوره ها</p>
            <p class="box__title">
                <a href="{{route('courses.create')}}" class="btn btn-webamooz_net">ثبت دوره جدید</a>
            </p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>ردیف</th>
                        <th>شناسه</th>
                        <th>بنر</th>
                        <th>عنوان</th>
                        <th>مدرس</th>
                        <th>قیمت</th>
                        <th>درس مدرس</th>
                        <th>نوع</th>
                        <th>وضعیت</th>
                        <th>وضعیت تایید</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $key => $course)
                        <tr role="row" class="">
                            <td>
                                <a href="">{{$course->priority}}</a>
                            </td>
                            <td>
                                <a href="">{{$course->id}}</a>
                            </td>
                            <td>
                                <img src="{{asset('storage/'.$course->banner->thumb)}}" width="80">
                            </td>
                            <td>
                                <a href="">{{$course->title}}</a>
                            </td>
                            <td>
                                <a href="">{{$course->teacher->name}}</a>
                            </td>
                            <td>
                                {{number_format($course->price)}}
                            </td>
                            <td>
                                {{$course->percent}} %
                            </td>
                            <td>@lang('LangCourses::messages.types.'.$course->type)</td>
                            <td class="status">@lang('LangCourses::messages.statuses.'.$course->status)</td>
                            <td class="confirmation_status">@lang('LangCourses::messages.confirmation_statuses.'.$course->confirmation_status)</td>
                            <td>
                                <a href="#" onclick="event.preventDefault(); deleteItem(event,'{{route('courses.destroy',$course)}}')" class="item-delete mlg-15" title="حذف"></a>
                                <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <a href="{{route('courses.edit',$course)}}" class="item-edit " title="ویرایش"></a>
                                <a href="#" onclick="event.preventDefault(); updateConfirmationStatus(event,'{{route('courses.accept',$course->id)}}','آیا از تایید این آیتم مطمین هستید؟','@lang('LangCourses::messages.confirmation_statuses.accepted')')" class="item-confirm mlg-15 " title="تایید"></a>
                                <a href="#" onclick="event.preventDefault(); updateConfirmationStatus(event,'{{route('courses.reject',$course->id)}}','آیا از رد شدن این آیتم مطمین هستید؟','@lang('LangCourses::messages.confirmation_statuses.rejected')')" class="item-reject mlg-15 " title="رد"></a>
                                <a href="#" onclick="event.preventDefault(); updateConfirmationStatus(event,'{{route('courses.lock',$course->id)}}','آیا از قفل کردن این آیتم مطمین هستید؟','@lang('LangCourses::messages.statuses.lock')','status')" class="item-lock mlg-15 " title="قفل کردن"></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection