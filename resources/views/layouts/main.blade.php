<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @yield('pageCss')
    <title>Rese</title>
</head>
<body>
    <nav class="menu" id="menu">
        <ul>
            <li><a href="/">Home</a></li>
            @auth
            <li>
                <form action="/logout" method="post" name="logout" id="logout">
                    @csrf
                    <a href="javascript:logout.submit()">Logout</a>
                </form>
            </li>
            @if(auth()->user()->role === 3)
            <li>
                <form action="/mypage" method="get" name="mypage" id="mypage">
                    @csrf
                    <a href="javascript:mypage.submit()">Mypage</a>
                </form>
            </li>
            @endif
            @if(auth()->user()->role === 1)
            <li>
                <form action="/admin" method="get" name="admin" id="admin">
                    @csrf
                    <a href="javascript:admin.submit()">Admin</a>
                </form>
            </li>
            @endif
            @if(auth()->user()->role === 2)
            <li>
                <form action="/owner" method="get" name="owner" id="owner">
                    @csrf
                    <a href="javascript:owner.submit()">Owner</a>
                </form>
            </li>
            @endif
            @endauth
            @guest
                <li>
                <form action="/register" method="get" name="register" id="register">
                    @csrf
                    <a href="javascript:register.submit()">Register</a>
                </form>
                </li>
                <li>
                <form action="/login" method="get" name="login" id="login">
                    @csrf
                    <a href="javascript:login.submit()">Login</a>
                </form>
                </li>
            @endguest
        </ul>
    </nav>
    <div class="container">
        <div class="header">
            <div class="logo_mark" id="logo_mark">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <h1 class="header_logo">Rese</h1>
        </div>
        @yield('content')
    </div>
<script src="{{ asset('js/main.js') }}"></script>
@yield('pageJs')
</body>
</html>