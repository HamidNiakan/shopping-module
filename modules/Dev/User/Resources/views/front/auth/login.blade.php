@extends('User::front.auth.master')

@section('styles')
@endsection

@section('scripts')
@endsection

@section('content')
    <form action="{{route('login')}}" class="form" method="post">
        @csrf
        <a class="account-logo" href="/">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="text" name="email"  class="txt-l txt @error('email') invaild @enderror" autofocus autocomplete="email" placeholder="ایمیل یا شماره موبایل">
            @error('email')
            <span class="invalid-feedback">
                {{$message}}
            </span>
            @enderror
            <input type="password" name="password" class="txt-l txt @error('password') invaild @enderror" placeholder="رمز عبور">
            @error('password')
            <span class="invalid-feedback">
                {{$message}}
            </span>
            @enderror
            <br>
            <button class="btn btn--login">ورود</button>
            <label class="ui-checkbox">
                مرا بخاطر داشته باش
                <input type="checkbox" name="remember" checked="checked">
                <span class="checkmark"></span>
            </label>
            <div class="recover-password">
                <a href="{{route('password.request')}}">بازیابی رمز عبور</a>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{route('register')}}">صفحه ثبت نام</a>
        </div>
    </form>
@endsection