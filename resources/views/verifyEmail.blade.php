@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/verifyEmail.css') }}">
@endsection

@section('content')
<div class="verify_container">
    <p>メール認証が完了していません<br>
        認証を完了してください
    </p>
    <form action="/email/verification-notification" method="post">
        @csrf
        <button type="submit" class="remail_btn">認証メールを再送信する</button>
    </form>
</div>
@endsection