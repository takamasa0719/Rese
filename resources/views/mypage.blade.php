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
            <form class="delete_form" action="/reserve/delete/{{ $reservation->id }}" method="post">
                @csrf
                <button type="submit" class="reservation_delete"></button>
            </form>
            <p class="reservation_id">予約{{ $reservation->id }}</p><br>
            <form class="update_form" action="/reserve/update/{{ $reservation->id }}" method="post">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                <table>
                    <tr>
                        <th>Shop</th>
                        <td><p class="reserve_shop">{{ $reservation->shop->name }}</p></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><input type="date" name="date" value="{{ $reservation->date}}"></td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td><input type="time" step="900" name="time" value="{{ substr($reservation->time, 0, 5) }}"></td>
                    </tr>
                    <tr>
                        <th>number</th>
                        <td><input type="number" name="number" value="{{ $reservation->number }}"></td>
                    </tr>
                </table>
                <button class="update_btn" type="submit">予約変更</button>
            </form>
        </div>
        @endforeach
        <p class="reservation_ttl">終了した予約</p>
        @foreach ($doneReservations as $doneReservation)
        <div class="reservation_content">
            <img src="{{ asset('images/clock.png') }}">
            <form class="delete_form" action="/reserve/delete/{{ $reservation->id }}" method="post">
                @csrf
                <button type="submit" class="reservation_delete"></button>
            </form>
            <p class="reservation_id">予約{{ $doneReservation->id }}</p><br>
                <table>
                    <tr>
                        <th>Shop</th>
                        <td><p class="reserve_shop">{{ $doneReservation->shop->name }}</p></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><p>{{ $doneReservation->date }}</p></td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td><p>{{ substr($doneReservation->time, 0, 5) }}</p></td>
                    </tr>
                    <tr>
                        <th>number</th>
                        <td><p>{{  $doneReservation->number }}人</p></td>
                    </tr>
                </table>
            <p>評価</p>
            <form action="">
                @csrf
                <div class="review_rating">
                    <input type="radio" id="rating1" name="rating" value="1" checked="checked">
                    <label for="rating1">★</label>
                    <input type="radio" id="rating2" name="rating" value="2">
                    <label for="rating2">★</label>
                    <input type="radio" id="rating3" name="rating" value="3">
                    <label for="rating3">★</label>
                    <input type="radio" id="rating4" name="rating" value="4">
                    <label for="rating4">★</label>
                    <input type="radio" id="rating5" name="rating" value="5">
                    <label for="rating5">★</label>
                </div>
            </form>
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