@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/owner.css') }}">
@endsection

@section('content')
<p class="owner_name">{{ Auth::user()->name }}さん</p>
<div class="ownerPage_container">
    <div class="shop_container">
        <p class="shop_ttl">店舗情報</p>
        <div class="shop_content">
        @if(isset($shop))
        <div class="shopAdd_form">
            <p class="add_ttl">店舗情報を編集</p>
            <form action="/shop/update/{{ $shop->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="店舗名" value="{{ $shop->name }}"><br>
                <select name="area_id">
                    <option value="">All area</option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{$area->id == $shop->area_id ?? '' ? 'selected' : ''}}>{{ $area->name }}</option>
                    @endforeach
                </select><br>
                <select name="category_id">
                    <option value="">All genre</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{$category->id == $shop->category_id ?? '' ? 'selected' : ''}}>{{ $category->name }}</option>
                    @endforeach
                </select><br>
                <textarea name="overview" cols="30" rows="5" placeholder="店舗詳細">{{ $shop->overview }}</textarea>
                <input type="file" name="image_path" accept=".jpg, .png" value="{{ $shop->image_path}}" required>
                <button class="add_btn"type="submit">更新</button>
            </form>
        </div>
        @else
        <p class="shop_until">店舗が登録されていません</p>
            <div class="shopAdd_form">
                <p class="add_ttl">店舗情報を登録</p>
                <form action="/shop/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" placeholder="店舗名"><br>
                    <select name="area_id">
                        <option value="">All area</option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select><br>
                    <select name="category_id">
                        <option value="">All genre</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select><br>
                    <textarea name="overview" cols="30" rows="5" placeholder="店舗詳細"></textarea>
                    <input type="file" name="image_path">
                    <button class="add_btn"type="submit">登録</button>
                </form>
            </div>
        @endif
        </div>
    </div>
    <div class="reservation_container">
        <p class="reservation_ttl">予約一覧</p>
        @foreach($reservations as $reservation)
        <div class="reservation_content">
            <table>
                <tr>
                    <th>予約者名</th>
                    <td>{{ $reservation->user->name }}さん</td>
                </tr>
                <tr>
                    <th>日付</th>
                    <td>{{ $reservation->date }}</td>
                </tr>
                <tr>
                    <th>時間</th>
                    <td>{{ substr($reservation-> time, 0, 5) }}</td>
                </tr>
                <tr>
                    <th>人数</th>
                    <td>{{ $reservation->number }}人</td>
                </tr>
            </table>
        </div>
        @endforeach
    </div>
</div>
@endsection