@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="reservation_container">
    <p>予約</p> 
    <form action="/reserve/{{ $shops[0]->id }}">
        @csrf
        <input type="date" name="date" id="date" onChange="inputDate()"><br>
        <input type="time" step="900" id="time" name="time"  onChange="inputTime()"><br>
        <input type="number" step="1" id="number" name="number" min="1" max="20" placeholder="人数" onChange="inputNumber()">
    </form>
    <div>
        <p id="dateOut"></p>
        <p id="timeOut"></p>
        <p id="numberOut"></p>
    </div>
</div>
<div class="shop_container">
    <form>
        <button class="return_btn" type="button" onClick="history.back()">＜</button>
    </form>
    <p class="shop_name">{{ $shops[0]->name }}</p>
    <img class="shop_image" src="{{ $shops[0]->image_path }}">
    <p class="shop_area">#{{ $shops[0]->area->name }}</p>
    <p class="shop_category">#{{ $shops[0]->category->name }}</p>
    <p class="shop_overview">{{ $shops[0]->overview }}</p>
</div>
@endsection

@section('pageJs')
<script src="{{ asset('js/detail.js') }}"></script>
@endsection