<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use App\Models\Reservation;
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
            ['visited', false],
            ])->get();
        $doneReservations = Shop::with(['reviews', 'reservations' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])->whereHas('reservations', function($query){
            $query->where('visited', true);
        })->get();
        return view('mypage', compact('shops', 'reservations', 'doneReservations'));
    }

    public function admin()
    {
        $owners = User::where('role', 2)->get();
        return view('admin', compact('owners'));
    }

}
