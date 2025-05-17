<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CommercialPrice;
use App\Models\RoomPrice;
use App\Models\PackagePrice;
use App\Models\AdditionalCost;

class PriceController extends Controller
{

    public function getAllPrices()
    {
        // $prices = [
        //     'commercialPrices' => [
        //         '1200' => 30000,
        //         '1800' => 7500000,
        //         '2200' => 9000000,
        //         '3000' => 12000000
        //     ],
        //     'roomPrices' => [
                  
        //   'bedroom'=> 51000,
        //   'bathroom'=> 90000,
        //   'drawing'=> 80000,
        //   'kitchen'=> 60000,
        //   'laundry'=> 20000
      
        //     ]
        // ];

        // return response()->json($prices);
        //   $commercialPrices = CommercialPrice::all()->pluck('price', 'size');
        // $roomPrices = RoomPrice::all()->pluck('price', 'room_type');
        
        // return response()->json([
        //     'commercialPrices' => $commercialPrices,
        //     'roomPrices' => $roomPrices
        // ]);


          return response()->json([
            'commercialPrices' => CommercialPrice::all()->pluck('price', 'size'),
            'roomPrices' => RoomPrice::all()->pluck('price', 'room_type'),
            'packagePrices' => PackagePrice::all()->pluck('price', 'package_type'),
            'additionalCosts' => AdditionalCost::all()->pluck('price', 'cost_type')
        ]);
    }


}
