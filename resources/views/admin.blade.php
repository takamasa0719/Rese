@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<p class="admin_name">{{ Auth::user()->name }}さん</p>
<div class="adminPage_container">
    <div class="ownerList_container">
        <p class="ownerList_ttl">店舗代表者一覧</p>
        @foreach($owners as $owner)
        <div class="owner_container">
            <table>
                <tr>
                    <th>店舗代表者名</th>
                    <td>{{ $owner->name }}</td>
                </tr>
            </table>
            <form class="delete_form" action="/owner/delete/{{ $owner->id }}" method="post">
                @csrf
                <button type="submit" class="owner_delete"></button>
            </form>
        </div>
        @endforeach
    </div>
    <div class="ownerAdd_container">
        <div class="ownerAdd_ttl">
            <p>店舗代表者を追加</p>
        </div>
        <div class="register_form">
            <form action="/owner/add" method="post">
                @csrf
                <input type="hidden" name="role" value=2>
                <img src="{{ asset('images/person.png') }}">
                <input type="text" name="name" placeholder="Username"><br>
                <img src="{{ asset('images/mail.png') }}">
                <input type="email" name="email" placeholder="Email"><br>
                <img src="{{ asset('images/key.png') }}">
                <input type="password" name="password" placeholder="Password"><br>
                <button class="register_btn"type="submit">登録</button>
            </form>
        </div>
    </div>
</div>
@endsection