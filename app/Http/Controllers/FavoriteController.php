<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function favorite(Request $request)
    {
        $favorite = new Favorite;
        $favorite->shop_id = $request->shop_id;
        $favorite->user_id = Auth::id();
        $favorite->save();
        return redirect('/');
    }

    public function unfavorite(Request $request)
    {
        Favorite::find($request->id)->delete();
        return redirect('/');
    }
}
