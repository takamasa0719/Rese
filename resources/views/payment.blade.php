@extends('layouts.main')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
<div class="payment_container">
    <p>予約内容確認</p>
    <div class="payment_info">
        <table>
            <tr>
                <th>店舗名</th>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <th>日付</th>
                <td>{{ $date }}</td>
            </tr>
            <tr>
                <th>時間</th>
                <td>{{ $time }}</td>
            </tr>
            <tr>
                <th>人数</th>
                <td>{{ $number }}人</td>
            </tr>
            <tr>
                <th>コース名</th>
                <td>{{ $course->name }}</td>
            </tr>
            <tr>
                <th>コース料金</th>
                <td>{{ $course->amount }}円</td>
            </tr>
        </table>
        <form action="/reserve/payment" method="POST">
            @csrf
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="{{ env('STRIPE_KEY') }}"
                    data-amount="{{ $course->amount }}"
                    data-name="コース料金を支払う"
                    data-label="決済をする"
                    data-description="コース料金を支払うと予約が確定"
                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                    data-locale="auto"
                    data-currency="JPY">
                </script>
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="time" value="{{ $time }}">
                <input type="hidden" name="number" value="{{ $number }}">
                <input type="hidden" name="shop_id" value="{{ $shop_id }}">
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <input type="hidden" name="amount" value="{{ $course->amount }}">
        </form>
    </div>
</div>
@endsection