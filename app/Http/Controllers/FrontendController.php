<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Marquee;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    private function getCommonData($additionalData = [])
    {
        $marquees = Marquee::where('is_active', 1)->get();
       // Fetch all news items

        // $pages = Page::all()->groupBy('district');


        // $settings = Setting::first(); 
        // $banner = Banner::where('frontpg', 1)->limit(10)->get();
        // return array_merge(['newsItems' => $newsItems, 'settings' => $settings, 'banner' => $banner, 'pages'=>$pages], $additionalData);
        return array_merge(['marquees' => $marquees], $additionalData);
    }

    public function index()
    {
        return view('welcome', $this->getCommonData());
    }
    public function products()
    {
        $products = Product::where('product_active', 1)->where('is_sell', 1)->get();
        return view('frontend.products', compact('products'));
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return view('frontend.item', compact('product'));
    }
    
//     public function showMarquee()
// {
//     $marquees = Marquee::where('is_active', 1)->get();
//     return view('your_view_file', compact('marquees'));
// }

}
