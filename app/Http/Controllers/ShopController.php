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
        $area_id = '';
        $keyword = '';
        $category_id = '';
        $shops = Shop::with(['area', 'category','favorites' => function ($query) use ($user_id) {
            $query->select(['id', 'shop_id'])->where('user_id', $user_id);
        }])->get();
        $areas = Area::all();
        $categories = Category::all();
        return view('index', compact('shops', 'areas', 'categories', 'area_id', 'category_id', 'keyword'));
    }

    public function detail(Request $request)
    {
        $shops = Shop::with(['area', 'category'])->where('id', $request->shop_id)->get();
        return view('detail', compact('shops'));
    }

    public function search(Request $request)
    {
        $area_id = $request->input('area');
        $category_id = $request->input('category');
        $keyword = $request->input('keyword');

        $query = Shop::query();

        if(!empty($area_id)){
            $query->where('area_id', $area_id);
        }
        
        if(!empty($category_id)){
            $query->where('category_id', $category_id);
        }

        if(!empty($keyword)){
            $query->where('name', 'like', '%'.$keyword.'%');
        }

        $shops = $query->get();
        $areas = Area::all();
        $categories = Category::all();
        
        return view('index', compact('shops', 'areas', 'categories', 'area_id', 'category_id', 'keyword'));
    }
}
