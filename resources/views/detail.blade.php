@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="reservation_container">
    <p class="reservation_ttl">予約</p> 
    <form action="/reserve" method="get">
        @csrf
        <input type="hidden" name="name" value="{{ $shops[0]->name }}">
        <input type="hidden" name="shop_id" value="{{ $shops[0]->id }}">
        <input type="date" class="form_date" name="date" id="date" onChange="inputDate()" required><br>
        <input type="time" class="form_time" step="900" id="time" name="time"  onChange="inputTime()" required><br>
        <input type="number" class="form_number" step="1" id="number" name="number" min="1" max="20" placeholder="人数" onChange="inputNumber()" required>
        <select name="course_id" id="course" onChange="inputCourse()">
            <option value="">コースを選択してください</option>
            @foreach($courses as $course)
            <option value="{{$course->id}}">{{$course->name}}　　{{$course->amount}}JPY</option>
            @endforeach
        </select>
        @if(Auth::check() && auth()->user()->role === 3)
        <button class="reservation_btn"type="submit">予約する</button>
        @endif
    </form>
    <div class="reservation_info">
        <table>
            <tr>
                <th>Shop</th>
                <td><p>{{ $shops[0]->name }}</p></td>
            </tr>
            <tr>
                <th>Date</th>
                <td><p id="dateOut"></p></td>
            </tr>
            <tr>
                <th>Time</th>
                <td><p id="timeOut"></p></td>
            </tr>
            <tr>
                <th>Number</th>
                <td><p id="numberOut"></p></td>
            </tr>
            <tr>
                <th>Course</th>
                <td><p id="courseOut"></p></td>
            </tr>
        </table>
    </div>
    <div class="reservation_bottom">
    </div>
</div>
<div class="shop_container">
    <form>
        <button class="return_btn" type="button" onClick="history.back()">＜</button>
    </form>
    <p class="shop_name">{{ $shops[0]->name }}</p>
    <img class="shop_image" src="{{ asset($shops[0]->image_path) }}">
    <p class="shop_area">#{{ $shops[0]->area->name }}</p>
    <p class="shop_category">#{{ $shops[0]->category->name }}</p>
    <p class="shop_overview">{{ $shops[0]->overview }}</p>
</div>
@endsection

@section('pageJs')
<script src="{{ asset('js/detail.js') }}"></script>
@endsection