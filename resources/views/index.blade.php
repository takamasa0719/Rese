@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<form class="search_form" id="search_form" onChange="submit(this.form);" method="get" action="/search">
    @csrf
    <div class="form_container">
        <div class="form_select">
            <select name="area">
                <option value="">All area</option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}" {{$area->id == $area_id ?? '' ? 'selected' : ''}}>{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form_select">
            <select name="category">
                <option value="">All genre</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{$category->id == $category_id ?? '' ? 'selected' : ''}}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form_input">
            <input type="search" placeholder="Search..." name="keyword" value="{{ $keyword }}">
        </div>
    </div>
</form>
<div class="main_container">
    @foreach($shops as $item)
    <div class="shop_container">
        <div class="shop_image">
            <img src="{{ asset('storage/images/' . $item->image_path) }}" alt="">
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
                @if(Auth::check() && auth()->user()->role === 3)
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

@section('pageJs')
<script src="{{ asset('js/index.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection