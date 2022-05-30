@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<form class="search_form" action="">
    @csrf
    <div class="form_container">
        <div class="form_select">
            <select name="area">
                <option value="0">All area</option>
                @foreach($areas as $area)
                <option value="{{ $area->id}}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form_select">
            <select name="category">
                <option value="0">All genre</option>
                @foreach($categories as $category)
                <option value="">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form_input">
            <input type="search" placeholder="Search...">
        </div>
    </div>
</form>
<div class="main_container">
    @foreach($shops as $item)
    <div class="shop_container">
        <div class="shop_image">
            <img src="{{ $item->image_path }}" alt="">
        </div>
        <div class="shop_content">
            <div class="content_sentence">
                <p class="shop_name">{{ $item->name }}</p>
                <p class="shop_area">#{{ $item->area->name }}</p>
                <p class="shop_category">#{{ $item->category->name }}</p>
            </div>
            <div class="content_btn">
                <form action="/detail/{{ $item->id }}" method="get">
                    @csrf
                    <button type="submit" class="shop_detail">詳しく見る</button>
                </form>
                @if(Auth::check())
                    @if(isset($item->favorites[0]))
                    <form action="/favorite/delete/{{ $item->favorites[0]->id }}" method="post">
                        @csrf
                        <button type="submit" class="shop_favorite"></button>
                    </form>
                    @else
                    <form action="/favorite/{{ $item->id }}" method="post">
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
@endsection