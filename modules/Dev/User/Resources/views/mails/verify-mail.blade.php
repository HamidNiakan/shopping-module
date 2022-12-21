@component('mail::message')
# کد فعال سازی حساب شما در وب آموز

این ایمیل برای ثبت نام در سایت وب آموز برای شما ارسال شده است.
در صورت اشتباه انرا نادیده بگرید

@component('mail::panel')
### کد فعال سازی شما :
{{$code}}
@endcomponent

باتشکر,<br>
{{ config('app.name') }}
@endcomponent
