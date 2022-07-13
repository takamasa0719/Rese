<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Course;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function done()
    {
        return view('reserved');
    }

    public function reserve(ReservationRequest $request)
    {
        $name = $request->name;
        $date = $request->date;
        $time = $request->time;
        $number = $request->number;
        $shop_id = $request->shop_id;
        $course = Course::where('id', $request->course_id)->first();

        return view('payment', compact(['name', 'date', 'time','number','shop_id', 'course']));
    }

    public function update(ReservationRequest $request)
    {
        Reservation::where('id', $request->reserve_id)->update([
            "user_id" => Auth::id(),
            "shop_id" => $request->shop_id,
            "date" => $request->date,
            "time" => $request->time,
            "number" => $request->number,
        ]);

        return back();
    }

    public function check(Request $request)
    {
        Reservation::where('id', $request->reserve_id)->update([
            "visited" => true,
        ]);
    }

    public function delete(Request $request)
    {
        Reservation::find($request->reserve_id)->delete();
        return back();
    }
}
