@extends('User::front.auth.master')

@section('styles')
@endsection

@section('scripts')
    <script src="{{asset('js/activation-code.js')}}"></script>
@endsection

@section('content')
    <div class="account act">
        <form action="{{ route('verification.verify') }}" class="form" method="post">
            @csrf
            <a class="account-logo" href="/">
                <img src="/img/weblogo.png" alt="">
            </a>
            <div class="card-header">
                <p class="activation-code-title">کد فرستاده شده به ایمیل  <span>{{ auth()->user()->email }}</span>
                                                 را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد.
                                                 ایمیلتان را اشتباه وارد کرده اید؟ <a href=""> برای ویرایش ایمیل کلیک کنید</a>.
                </p>
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session()->get('error')}}
                    </div>
                @endif
            </div>
            <div class="form-content form-content1">
                <input name="verify_code" required class="activation-code-input" placeholder="فعال سازی">
                <br>
                @error('verify_code')
                <span class="invalid-feedback">
                    {{$message}}
                </span>
                @enderror
                <button type="submit" class="btn i-t">تایید</button>
                <a href="#" onclick="event.preventDefault();document.getElementById('resend-code').submit()">ارسال مجدد د فعالسازی</a>

            </div>
            <div class="form-footer">
                <a href="{{ route('register') }}">صفحه ثبت نام</a>
            </div>
        </form>
        <form id="resend-code" action="{{route('verification.resend')}}" method="POST">
            @csrf
        </form>
    </div>
@endsection