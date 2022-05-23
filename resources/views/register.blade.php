@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register_container">
    <div class="register_ttl">
        <p>Registration</p>
    </div>
    <div class="register_form">
        <form action="">
            @csrf
            <img src="{{ asset('images/person.png') }}">
            <input type="text" placeholder="Username"><br>
            <img src="{{ asset('images/mail.png') }}">
            <input type="email" placeholder="Email"><br>
            <img src="{{ asset('images/key.png') }}">
            <input type="password" placeholder="Password"><br>
            <button class="register_btn"type="submit">登録</button>
        </form>
    </div>
</div>
@endsection