<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function favorite(Request $request)
    {
        Favorite::create([
            "shop_id" => $request->shop_id,
            "user_id" => Auth::id(),
        ]);
        return back();
    }

    public function unfavorite(Request $request)
    {
        Favorite::find($request->favorite_id)->delete();
        return back();
    }
}
