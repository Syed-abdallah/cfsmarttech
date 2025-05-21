<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total revenue calculation
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total');
        
        // New orders (last 7 days)
        $newOrdersCount = Order::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        
        // Monthly revenue
        $monthlyRevenue = Order::where('status', '!=', 'cancelled')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('total');
            
        // Products sold
        $productsSold = OrderItem::has('order')->sum('quantity');
        
        // Recent orders
        $recentOrders = Order::with('items')->latest()->take(10)->get();
        
        // Daily sales for chart (last 30 days)
        $dailySales = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dailySales[$date] = Order::whereDate('created_at', $date)
                ->where('status', '!=', 'cancelled')
                ->sum('total');
        }
        
        // Payment method breakdown
        $paymentMethods = Order::select('payment_method')
            ->selectRaw('SUM(total) as total')
            ->where('status', '!=', 'cancelled')
            ->groupBy('payment_method')
            ->get();
            
        $paymentMethodData = [];
        foreach ($paymentMethods as $method) {
            $paymentMethodData[ucfirst(str_replace('-', ' ', $method->payment_method))] = $method->total;
        }
        
        // Order status counts
        $processingOrders = Order::where('status', 'processing')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        
        $orderStatusData = [
            'Processing' => $processingOrders,
            'Shipped' => $shippedOrders,
            'Completed' => $completedOrders,
            'Cancelled' => $cancelledOrders,
        ];
        
        // Payment method totals
        $onlinePayments = Order::where('payment_method', 'online')->where('status', '!=', 'cancelled')->sum('total');
        $bankTransfers = Order::where('payment_method', 'bank-transfer')->where('status', '!=', 'cancelled')->sum('total');
        $codPayments = Order::where('payment_method', 'cod')->where('status', '!=', 'cancelled')->sum('total');
        
        // Top selling products
        // $topProducts = OrderItem::select('product_id', 'product_name')
        //     ->selectRaw('SUM(quantity) as total_sold')
        //     ->with(['product' => function($query) {
        //         $query->select('id', 'image_url');
        //     }])
        //     ->groupBy('product_id', 'product_name')
        //     ->orderByDesc('total_sold')
        //     ->take(5)
        //     ->get();
         $topProducts  = [];
            
        $maxProductSales = $topProducts->max('total_sold') ?? 1;
        
        // Recent activities (you would need an Activity model for this)
        $recentActivities = []; // Replace with actual activity query
        
        return view('dashboard', compact(
            'totalRevenue',
            'newOrdersCount',
            'monthlyRevenue',
            'productsSold',
            'recentOrders',
            'dailySales',
            'paymentMethodData',
            'orderStatusData',
            'topProducts',
            'maxProductSales',
            'recentActivities',
            'processingOrders',
            'shippedOrders',
            'completedOrders',
            'cancelledOrders',
            'onlinePayments',
            'bankTransfers',
            'codPayments'
        ));
    }
}