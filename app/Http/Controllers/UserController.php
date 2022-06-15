<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Shop;
use App\models\Reservation;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage()
    {
        $user_id = Auth::id();
        $shops = Shop::with(['area', 'category','favorites' => function ($query) use ($user_id) {
            $query->select(['id', 'shop_id'])->where('user_id', $user_id);
        }])->whereHas('favorites', function ($query){
            $query->whereExists(function($query){
                return $query;
            });
        })->get();
        $reservations = Reservation::where([
            ['user_id', $user_id],
            ['date', '>', date('Y-m-d')],
            ])->get();
        $doneReservations = Reservation::where([
            ['user_id', $user_id],
            ['date', '<=', date('Y-m-d')]
        ])->get();
        return view('mypage', compact('shops', 'reservations', 'doneReservations'));
    }
}
