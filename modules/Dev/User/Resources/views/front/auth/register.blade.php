@extends('User::front.auth.master')

@section('styles')
@endsection

@section('scripts')
@endsection

@section('content')
    <form action="{{route('register')}}" class="form" method="post">
        @csrf
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="text" name="name" autocomplete="name" value="{{old('name')}}" autofocus class="txt @error('name')is-valid @enderror" placeholder="نام و نام خانوادگی *">
            @error('name')
            <span class="invalid-feedback">
                {{$message}}
            </span>
            @enderror
            <input type="text" class="txt txt-l @error('email') is-valid  @enderror" value="{{old('email')}}" name="email" autocomplete="email" placeholder="ایمیل *">
            @error('email')
            <span class="invalid-feedback">
                {{$message}}
            </span>
            @enderror
            <input type="text" name="mobile" value="{{old('mobile')}}" autocomplete="mobile" class="txt @error('mobile') is-valid @enderror" placeholder="شماره موبایل">
            @error('mobile')
            <span class="invalid-feedback">
                {{$message}}
            </span>
            @enderror
            <input type="password" class="txt txt-l @error('password') is-valid @enderror" name="password" autocomplete="new" placeholder="رمز عبور *">
            @error('password')
            <span class="invalid-feedback">
                {{$message}}
            </span>
            @enderror
            <input type="password" class="txt txt-l @error('password_confirmation') is-valid @enderror" name="password_confirmation" autocomplete="new" placeholder="تکرار رمزعبور *">
            @error('password_confirmation')
            <span class="invalid-feedback">
                {{$message}}
            </span>
            @enderror
            <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
            <br>
            <button class="btn continue-btn">ثبت نام و ادامه</button>

        </div>
        <div class="form-footer">
            <a href="{{route('login')}}">صفحه ورود</a>
        </div>
    </form>
@endsection