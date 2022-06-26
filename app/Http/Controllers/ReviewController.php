<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function review(Request $request)
    {
        Review::create([
            "user_id" => Auth::id(),
            "shop_id" => $request->shop_id,
            "rating" => $request->rating,
            "review" => $request->review,
        ]);

        return back();
    }

    public function update(Request $request)
    {
        Review::where('id', $request->review_id)->update([
            "user_id" => Auth::id(),
            "shop_id" => $request->shop_id,
            "rating" => $request->rating,
            "review" => $request->review,
        ]);

        return back();
    }
}
