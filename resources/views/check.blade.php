@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/check.css') }}">
@endsection

@section('content')
<div class="check_container">
    <p class="check_ttl">下記の予約の来店確認を行います</p>
    <table>
        <tr>
            <th>Shop</th>
            <td><p class="reserve_shop">{{ $reservation->shop->name }}</p></td>
        </tr>
        <tr>
            <th>Date</th>
            <td><p class="reserve_shop">{{ $reservation->date }}</p></td>
        </tr>
        <tr>
            <th>Time</th>
            <td><p class="reserve_shop">{{ substr($reservation->time, 0, 5) }}</p></td>
        </tr>
        <tr>
            <th>number</th>
            <td><p class="reserve_shop">{{ $reservation->number }}人</p></td>
        </tr>
    </table>
    <form action="/reserve/check/{{ $reservation_id }}" method="post">
        @csrf
        <button type="submit" class="check_btn">来店確認</button>
    </form>
</div>
@endsection