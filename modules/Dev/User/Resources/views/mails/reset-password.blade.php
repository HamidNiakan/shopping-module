@component('mail::message')
# کد بازیابی رمزعبور شما در وب آموز

این ایمیل برای بازیابی رمز عبور شما  در سایت وب آموز برای شما ارسال شده است.
در صورت اشتباه انرا نادیده بگرید

@component('mail::panel')
### کد بازیابی رمزعبور شما :
{{$code}}
@endcomponent

باتشکر,<br>
{{ config('app.name') }}
@endcomponent
