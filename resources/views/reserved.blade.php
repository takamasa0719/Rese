@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/reserved.css') }}">
@endsection

@section('content')
<div class="reserved_container">
    <p>ご予約ありがとうございます</p>
    <form action="/" method="get">
        @csrf
        <button type="submit" class="back_btn">戻る</button>
    </form>
</div>
@endsection