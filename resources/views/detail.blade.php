@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="reservation_container">
    <p class="reservation_ttl">予約</p> 
    <form action="/reserve/{{ $shops[0]->id }}" method="post">
        @csrf
        <input type="date" class="form_date" name="date" id="date" onChange="inputDate()"><br>
        <input type="time" class="form_time" step="900" id="time" name="time"  onChange="inputTime()"><br>
        <input type="number" class="form_number" step="1" id="number" name="number" min="1" max="20" placeholder="人数" onChange="inputNumber()">
        <button class="reservation_btn"type="submit">予約する</button>
    </form>
    <div class="reservation_info">
        <span>Shop</span><p>{{ $shops[0]->name }}</p><br>
        <span>Date</span><p id="dateOut"></p><br>
        <span>Time</span><p id="timeOut"></p><br>
        <span>Number</span><p id="numberOut"></p><br>
    </div>
    <div class="reservation_bottom">
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