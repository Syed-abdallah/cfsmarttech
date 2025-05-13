<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class CustomerDashboardController extends Controller
{
 

    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $activeOrders = $customer->orders()->whereNotIn('status', ['completed', 'cancelled'])->count();
        $completedOrders = $customer->orders()->where('status', 'completed')->count();
        $pendingRequests = $customer->orders()->where('status', 'pending')->count();
        $totalSpent = $customer->orders()->sum('total');
        
        $recentOrders = $customer->orders()
        ->with(['items.product'])
        ->latest()
        ->take(5)
        ->get();
        // dd($recentOrders);
            
       $recentActivities = $recentOrders->map(function ($order) {
        return [
            'icon' => $this->getActivityIcon($order->status),
            'title' => $this->getActivityTitle($order->status),
            'order_number' => $order->order_number,
            'description' => $this->getActivityDescription($order),
            'time' => $order->created_at->diffForHumans(),
            'order_id' => $order->id
        ];
    });
      $recommendedProducts = Product::where('product_active', true)
            ->where('is_sell', true)
            ->latest()
            ->take(8)
            ->get();

        return view('customer.dashboard', compact(
            'activeOrders',
            'completedOrders',
            'pendingRequests',
            'totalSpent',
            'recentOrders',
            'recentActivities',
            'recommendedProducts'
        ));
    }



    private function getActivityIcon($status)
{
    $icons = [
        'pending' => 'clock',
        'processing' => 'package',
        'shipped' => 'truck',
        'delivered' => 'check-circle',
        'cancelled' => 'x-circle'
    ];
    
    return $icons[$status] ?? 'shopping-bag';
}

private function getActivityTitle($status)
{
    $titles = [
        'pending' => 'Order Placed',
        'processing' => 'Order Processing',
        'shipped' => 'Order Shipped',
        'delivered' => 'Order Delivered',
        'cancelled' => 'Order Cancelled'
    ];
    
    return $titles[$status] ?? 'Order Update';
}

private function getActivityDescription($order)
{
    $descriptions = [
        'pending' => "Your order #{$order->order_number} has been received and is being processed.",
        'processing' => "Your order #{$order->order_number} is being prepared for shipment.",
        'shipped' => "Your order #{$order->order_number} has been shipped with {$order->shipping_carrier}.",
        'delivered' => "Your order #{$order->order_number} has been successfully delivered.",
        'cancelled' => "Your order #{$order->order_number} has been cancelled."
    ];
    
    return $descriptions[$order->status] ?? "Update for your order #{$order->order_number}";
}
}
