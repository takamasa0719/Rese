<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reserveConfirm.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <p>{{ $reserve->user->name }}様</p>
        <p>本日来店予定のご予約があります。</p>
        <div class="content">
            <table>
                <tr>
                    <th>店舗名</th>
                    <td>{{ $reserve->shop->name }}</td>
                </tr>
                <tr>
                    <th>日付</th>
                    <td>{{ $reserve->date }}</td>
                </tr>
                <tr>
                    <th>時間</th>
                    <td>{{ $reserve->time }}</td>
                </tr>
                <tr>
                    <th>人数</th>
                    <td>{{ $reserve->number }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>