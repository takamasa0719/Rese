<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Shop;
use App\models\Area;
use App\models\Category;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $shops = Shop::with(['area', 'category','favorites' => function ($query) use ($user_id) {
                $query->select(['id', 'shop_id'])->where('user_id', $user_id);
            }])->get();
        $areas = Area::all();
        $categories = Category::all();
        return view('index', compact('shops', 'areas', 'categories'));
    }

    public function detail(Request $request)
    {
        $shops = Shop::with(['area', 'category'])->where('id', $request->shop_id)->get();
        return view('detail', compact('shops'));
    }

    public function search(Request $request)
    {
        $area = $request->input('area');
        $category = $request->input('category');
        $keyword = $request->input('keyword');

        $query = Shop::query();

        if(!empty($area)){
            $query->where('area_id', $area);
        }
        
        if(!empty($category)){
            $query->where('category_id', $category);
        }

        if(!empty($keyword)){
            $query->where('name', 'like', '%'.$keyword.'%');
        }

        $shops = $query->get();
        
        return response()->json($shops);
    }
}
