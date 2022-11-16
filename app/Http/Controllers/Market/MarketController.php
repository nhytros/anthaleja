<?php

namespace App\Http\Controllers\Market;

use App\Models\Market\Banner;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class MarketController extends Controller
{
    public function index()
    {
        $mf = Banner::where(['type' => 'fix', 'status' => 1])->count();
        $mf = $mf > 3 ? 3 : $mf;
        $slides = Banner::where(['type' => 'slide', 'status' => 1])->get();
        $fixed = Banner::where(['type' => 'fix', 'status' => 1])->inRandomOrder()->limit($mf)->get();
        $latest = Product::where('status', 1)->orderBy('created_at', 'desc')->latest()->limit(8)->get();
        $best = Product::where(['status' => 1, 'is_bestseller' => 1])->inRandomOrder()->limit(8)->get();
        $discounted = Product::where('discount', '>', 0)->inRandomOrder()->limit(8)->get();
        $featured = Product::where(['status' => 1, 'is_featured' => 1])->inRandomOrder()->limit(8)->get();
        return view('market.frontend.index', [
            'title' => 'Market',
        ], compact('slides', 'fixed', 'latest', 'best', 'discounted', 'featured'));
    }
}
