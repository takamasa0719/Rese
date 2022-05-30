@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login_container">
    <div class="login_ttl">
        <p>Login</p>
    </div>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="login_form">
        <form action="/login" method="post">
            @csrf
            <img src="{{ asset('images/mail.png') }}">
            <input type="email" name="email" placeholder="Email"><br>
            <img src="{{ asset('images/key.png') }}">
            <input type="password" name="password" placeholder="Password"><br>
            <button class="login_btn"type="submit">ログイン</button>
        </form>
    </div>
</div>
@endsection