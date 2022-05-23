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
    <div class="container">
        <div class="header">
            <div class="logo_mark">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <h1 class="header_logo">Rese</h1>
        </div>
        @yield('content')
    </div>
</body>
</html>