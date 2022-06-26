@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register_container">
    <div class="register_ttl">
        <p>Registration</p>
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
    <div class="register_form">
        <form action="/register" method="post">
            @csrf
            <input type="hidden" name="role" value=3>
            <img src="{{ asset('images/person.png') }}">
            <input type="text" name="name" placeholder="Username"><br>
            <img src="{{ asset('images/mail.png') }}">
            <input type="email" name="email" placeholder="Email"><br>
            <img src="{{ asset('images/key.png') }}">
            <input type="password" name="password" placeholder="Password"><br>
            <img src="{{ asset('images/key.png') }}">
            <input type="password" name="password_confirmation" placeholder="Password Confirm"><br>
            <button class="register_btn"type="submit">登録</button>
        </form>
    </div>
</div>
@endsection