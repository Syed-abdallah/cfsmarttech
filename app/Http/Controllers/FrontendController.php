<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Partner;
use App\Models\Marquee;
use App\Models\Slider;
use App\Models\SiteSettings;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    private function getCommonData($additionalData = [])
    {
        $marquees = Marquee::where('is_active', 1)->get();
       // Fetch all news items

        // $pages = Page::all()->groupBy('district');
  $settings = SiteSettings::firstOrNew();

        // $settings = Setting::first(); 
        // $banner = Banner::where('frontpg', 1)->limit(10)->get();
        // return array_merge(['newsItems' => $newsItems, 'settings' => $settings, 'banner' => $banner, 'pages'=>$pages], $additionalData);
        return array_merge(['marquees' => $marquees , 'settings'=> $settings], $additionalData);
    }

    public function index()
    {
          $products = Product::where('product_active', 1)
                          ->where('is_sell', 1)
                          ->orderBy('created_at', 'desc')
                          ->take(6) // Get 5 active products
                          ->get();
        $slides = Slider::where('is_active', 1)->get();
        $partners = Partner::where('is_active', 1)->get();

        
        return view('welcome', array_merge(compact('slides', 'partners','products'), $this->getCommonData()));
    }
    public function products()
    {
        $products = Product::where('product_active', 1)->where('is_sell', 1)->get();
    return view('frontend.products', array_merge(compact('products'), $this->getCommonData()));
}
public function messageFromManagement(){
      
    return view('frontend.ourmessage', $this->getCommonData());
}
    public function show($id) {
        $product = Product::findOrFail($id);
    
        return view('frontend.item', array_merge(compact('product'), $this->getCommonData()));
    }
    
    public function carts()
    {
// Get authenticated customer (with null check)
$customer = auth('customer')->user();

if (!$customer) {
    // Handle unauthenticated case - redirect or show empty data
    return view('frontend.cart', array_merge([
        'shipping' => null,
        'shippingCost' => "",
        'shippingState' => ""
    ], $this->getCommonData()));
}

// Get default shipping address
$shipping = CustomerAddress::where('customer_id', $customer->id)
                          ->where('is_default', 1)
                          ->first();
                          
                          // Calculate shipping cost
                          $shippingCost = "";
                          $shippingState = "";
                          
                          if ($shipping) {
                              $shippingState = $shipping->state ?? "";
                              $shippingCost = (strtolower($shippingState) == 'punjab') ? 300 : 400;
                            }
                            // dd($shipping);
return view('frontend.cart', array_merge([
    'shipping' => $shipping,
    'shippingCost' => $shippingCost,
    'shippingState' => $shippingState
], $this->getCommonData()));
    }
    public function calculator()
    {
        return view('frontend.calculator', $this->getCommonData());
    }



public function history(){
        return view('frontend.history', $this->getCommonData());
}
public function goal(){
        return view('frontend.goal', $this->getCommonData());
}
public function offering(){
        return view('frontend.offering', $this->getCommonData());
}
public function audit(){
        return view('frontend.audit', $this->getCommonData());
}
public function case(){
        return view('frontend.casestudy', $this->getCommonData());
}



    //     public function showMarquee()
// {
//     $marquees = Marquee::where('is_active', 1)->get();
//     return view('your_view_file', compact('marquees'));
// }

}
