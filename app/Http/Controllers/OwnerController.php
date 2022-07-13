<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\models\Shop;
use App\Models\Reservation;
use App\models\Area;
use App\models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function index()
    {
        $owner_id = Auth::id();
        $shop_id = Shop::where('owner_id', $owner_id)->first(['id']);
        $shop = Shop::where('owner_id', $owner_id)->first();

        if(isset($shop)){
            $reservations = Reservation::with(['user', 'shop' => function ($query) use ($owner_id) {
                $query->where('owner_id', $owner_id);
            }])->where('shop_id', $shop_id->id)->get();
        }else{
            $reservations = [];
        };
        $areas = Area::all();
        $categories = Category::all();

        return view('owner', compact('shop', 'reservations', 'areas', 'categories'));
    }

    public function owner(Request $request)
    {
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role,
        ]);

        return back();
    }

    public function delete(Request $request)
    {
        User::find($request->owner_id)->delete();
        return back();
    }
}
