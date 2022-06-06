<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function done()
    {
        return view('reserved');
    }

    public function reserve(Request $request)
    {
        Reservation::create([
            "user_id" => Auth::id(),
            "shop_id" => $request->shop_id,
            "date" => $request->date,
            "time" => $request->time,
            "number" => $request->number,
        ]);

        return redirect('/done');
    }

    public function delete(Request $request)
    {
        Reservation::find($request->reserve_id)->delete();
        return back();
    }
}
