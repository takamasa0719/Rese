@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks_container">
    <p>会員登録ありがとうございます</p>
    <form action="/login" method="get">
        @csrf
        <button type="submit" class="login_btn">ログインする</button>
    </form>
</div>
@endsection