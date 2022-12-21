@extends('User::front.auth.master')

@section('styles')
@endsection

@section('scripts')
@endsection

@section('content')
    <form action="{{route('password.verify.code.email')}}" class="form" method="get">
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
        @endif
        <a class="account-logo" href="/">
            <img src="{{asset('img')}}/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="email" name="email" value="{{old('email')}}" autocomplete="email" autofocus class="txt-l txt" placeholder="ایمیل">
            @error('email')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <br>
            <button type="submit" class="btn btn-recoverpass">بازیابی</button>
        </div>
        <div class="form-footer">
            <a href="{{route('login')}}">صفحه ورود</a>
        </div>
    </form>
@endsection