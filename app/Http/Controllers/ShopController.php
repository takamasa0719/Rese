<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Shop;
use App\models\Area;
use App\models\Category;

class ShopController extends Controller
{
    public function index()
    {
        $items = Shop::with(['area', 'category'])->get();
        $areas = Area::all();
        $categories = Category::all();
        return view('index', compact('items', 'areas', 'categories'));
    }

    public function detail(Request $request)
    {
        $items = Shop::with(['area', 'category'])->where('id', '=', $request->id)->get();
        return view('detail', compact('items'));
    }
}
