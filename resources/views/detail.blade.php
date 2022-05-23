@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="reservation_container">

</div>
<div class="shop_container">
    <form>
        <button class="return_btn" type="button" onClick="history.back()">＜</button>
    </form>
    <p class="shop_name">{{ $items[0]->name }}</p>
    <img class="shop_image" src="{{ $items[0]->image_path }}">
    <p class="shop_area">#{{ $items[0]->area->name }}</p>
    <p class="shop_category">#{{ $items[0]->category->name }}</p>
    <p class="shop_overview">{{ $items[0]->overview }}</p>
</div>
@endsection