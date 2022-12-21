@extends('User::front.auth.master')

@section('styles')
@endsection

@section('scripts')
@endsection

@section('content')
    <form action="{{route('password.update')}}" class="form" method="post">
        @csrf
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
        @endif
        <a class="account-logo" href="/">
            <img src="{{asset('img')}}/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="hidden" name="token" value="{{$token}}">
            <input type="email" name="email" value="{{$email ?? old('email')}}" autocomplete="email" autofocus class="txt-l txt" placeholder="ایمیل">
            @error('email')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <br>
            <input type="password" class="txt txt-l @error('password') @enderror" name="password" autocomplete="new" placeholder="رمز عبور جدید *">
            @error('password')
            <span class="invalid-feedback">
                {{$message}}
            </span>
            @enderror
            <input type="password" class="txt txt-l @error('password_confirmation') @enderror" name="password_confirmation" autocomplete="new" placeholder="تکرار رمزعبور جدید *">
            @error('password_confirmation')
            <span class="invalid-feedback">
                {{$message}}
            </span>
            @enderror
            <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
            <br>
            <button class="btn continue-btn">بروزرسانی رمز عبور</button>
        </div>
        <div class="form-footer">
            <a href="{{route('login')}}">صفحه ورود</a>
        </div>
    </form>
@endsection