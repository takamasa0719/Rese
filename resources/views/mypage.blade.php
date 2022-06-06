@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<p class="user_name">{{ Auth::user()->name }}さん</p>
<div class="mypage_container">
    <div class="reservation_container">
        <p class="reservation_ttl">予約状況</p>
        @foreach($reservations as $reservation)
        <div class="reservation_content">
            <img src="{{ asset('images/clock.png') }}">
            <form action="/reserve/delete/{{ $reservation->id }}" method="post">
                @csrf
                <button type="submit" class="reservation_delete"></button>
                </form>
            <p class="reservation_id">予約{{ $reservation->id }}</p><br>
            <span>Shop</span><p>{{ $reservation->shop->name }}</p><br>
            <span>Date</span><p>{{ $reservation->date }}</p><br>
            <span>Time</span><p>{{ $reservation->time }}</p><br>
            <span>Number</span><p class="reservation_number">{{ $reservation->number }}人</p><br>
        </div>
        @endforeach
    </div>
    <div class="favorite_container">
        <p class="favorite_ttl">お気に入り店舗</p>
        <div class="shop_wrapper">
            @foreach($shops as $shop)
            <div class="shop_container">
            <div class="shop_image">
                <img src="{{ $shop->image_path }}" alt="">
            </div>
            <div class="shop_content">
                <div class="content_sentence">
                    <p class="shop_name">{{ $shop->name }}</p>
                    <p class="shop_area">#{{ $shop->area->name }}</p>
                    <p class="shop_category">#{{ $shop->category->name }}</p>
                </div>
                <div class="content_btn">
                    <form action="/detail/{{ $shop->id }}" method="get">
                        @csrf
                        <button type="submit" class="shop_detail">詳しく見る</button>
                    </form>
                    @if(Auth::check())
                        @if(isset($shop->favorites[0]))
                        <form action="/favorite/delete/{{ $shop->favorites[0]->id }}" method="post">
                            @csrf
                            <button type="submit" class="shop_favorite"></button>
                        </form>
                        @else
                        <form action="/favorite/{{ $shop->id }}" method="post">
                            @csrf
                            <button type="submit" class="shop_unfavorite"></button>
                        </form>
                        @endif
                    @endif
                </div>
            </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection