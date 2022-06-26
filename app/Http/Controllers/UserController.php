<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Shop;
use App\models\User;
use App\models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        })->whereHas('favorites', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();
        $reservations = Reservation::where([
            ['user_id', $user_id],
            ['date', '>', date('Y-m-d')],
            ])->get();
        $doneReservations = Shop::with(['reviews', 'reservations' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])->whereHas('reservations', function($query){
            $query->where('date', '<=', date('Y-m-d'));
        })->get();
        return view('mypage', compact('shops', 'reservations', 'doneReservations'));
    }

    public function admin()
    {
        $owners = User::where('role', 2)->get();
        return view('admin', compact('owners'));
    }

}
