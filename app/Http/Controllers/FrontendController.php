<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Marquee;
use App\Models\CustomerAddress;
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
    return view('frontend.products', array_merge(compact('products'), $this->getCommonData()));
}

    public function show($id) {
        $product = Product::findOrFail($id);
    
        return view('frontend.item', array_merge(compact('product'), $this->getCommonData()));
    }
    
    public function carts()
    {
// Get default shipping address (or null if none exists)
$shipping = CustomerAddress::where('customer_id', auth('customer')->user()->id)
                          ->where('is_default', 1)
                          ->first();

// Calculate shipping cost
$shippingCost = "";
$shippingState = "";

if ($shipping) {
    $shippingState = $shipping->state ?? "";
    $shippingCost = (strtolower($shippingState) == 'punjab') ? 300 : 400;
}

// Prepare view data
$viewData = [
    'shipping' => $shipping,
    'shippingCost' => $shippingCost,
    'shippingState' => $shippingState
];

return view('frontend.cart', array_merge($viewData, $this->getCommonData()));
    }
    public function calculator()
    {
        return view('frontend.calculator', $this->getCommonData());
    }
    //     public function showMarquee()
// {
//     $marquees = Marquee::where('is_active', 1)->get();
//     return view('your_view_file', compact('marquees'));
// }

}
