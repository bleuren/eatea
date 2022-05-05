<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Product;
use App\Models\Map;

class HomeController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        /*
        $news = Post::where('category_id', Category::where('slug', 'news')->first()->id)
        ->inRandomOrder()
        ->limit(4)
        ->get();
        $recommends = Post::where('category_id', Category::where('slug', 'recommends')->first()->id)
        ->inRandomOrder()
        ->limit(4)
        ->get();
         */
        $products = Product::where('enabled', true)->get();
        return view('home', compact('carousels', 'products'));
    }
    public function map()
    {
        return Map::whereNotNull(['lat', 'lon'])->whereIn('city', ['台北市', '新北市'])->whereNotIn('district', ['石門區', '鶯歌區', '平溪區', '烏來區', '金山區', '雙溪區', '瑞芳區', '貢寮區', '石碇區', '萬里區', '三芝區', '三峽區', '五股區', '坪林區', '八里區', '泰山區'])->inRandomOrder()->get(['lat', 'lon'])->toJson();
    }
}
