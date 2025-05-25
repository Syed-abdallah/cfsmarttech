<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Date filtering
        $startDate = $request->input('start_date') 
            ? Carbon::parse($request->input('start_date'))->startOfDay() 
            : Carbon::now()->subDays(30);
            
        $endDate = $request->input('end_date') 
            ? Carbon::parse($request->input('end_date'))->endOfDay() 
            : Carbon::now();

        // Base query for orders
        $orderQuery = Order::query()
            ->whereBetween('created_at', [$startDate, $endDate]);

        // Total revenue calculation (excluding cancelled orders)
        $totalRevenue = (clone $orderQuery)
            ->where('status', '!=', 'cancelled')
            ->sum('total');
        
        // New orders count (last 7 days)
        $newOrdersCount = Order::where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();
        
        // Monthly revenue (current month)
        $monthlyRevenue = Order::where('status', '!=', 'cancelled')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('total');
            
        // Products sold (only from completed orders)
        $productsSold = OrderItem::whereHas('order', function($query) {
                $query->where('status', 'completed');
            })->sum('quantity');
        
        // Recent orders (filtered by date range if specified)
        $recentOrders = (clone $orderQuery)
            ->with('items')
            ->latest()
            ->take(10)
            ->get();
        
        // Daily sales for chart (based on filtered date range)
        $dailySales = [];
        $dateRange = Carbon::parse($startDate)->daysUntil($endDate);
        
        foreach ($dateRange as $date) {
            $formattedDate = $date->format('Y-m-d');
            $dailySales[$formattedDate] = Order::whereDate('created_at', $formattedDate)
                ->where('status', '!=', 'cancelled')
                ->sum('total');
        }
        
        // Payment method breakdown
        $paymentMethods = (clone $orderQuery)
            ->select('payment_method')
            ->selectRaw('SUM(total) as total')
            ->where('status', '!=', 'cancelled')
            ->groupBy('payment_method')
            ->get();
            
        $paymentMethodData = [];
        foreach ($paymentMethods as $method) {
            $paymentMethodData[ucfirst(str_replace('-', ' ', $method->payment_method))] = $method->total;
        }
        
        // Order status counts
        $statusCounts = (clone $orderQuery)
            ->select('status')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');
            
        $processingOrders = $statusCounts['processing'] ?? 0;
        $shippedOrders = $statusCounts['shipped'] ?? 0;
        $completedOrders = $statusCounts['completed'] ?? 0;
        $cancelledOrders = $statusCounts['cancelled'] ?? 0;
        
        $orderStatusData = [
            'Processing' => $processingOrders,
            'Shipped' => $shippedOrders,
            'Completed' => $completedOrders,
            'Cancelled' => $cancelledOrders,
        ];
        
        // Payment method totals
        $onlinePayments = (clone $orderQuery)
            ->where('payment_method', 'online')
            ->where('status', '!=', 'cancelled')
            ->sum('total');
            
        $bankTransfers = (clone $orderQuery)
            ->where('payment_method', 'bank-transfer')
            ->where('status', '!=', 'cancelled')
            ->sum('total');
            
        $codPayments = (clone $orderQuery)
            ->where('payment_method', 'cod')
            ->where('status', '!=', 'cancelled')
            ->sum('total');
        
        return view('dashboard', compact(
            'totalRevenue',
            'newOrdersCount',
            'monthlyRevenue',
            'productsSold',
            'recentOrders',
            'dailySales',
            'paymentMethodData',
            'orderStatusData',
            'processingOrders',
            'shippedOrders',
            'completedOrders',
            'cancelledOrders',
            'onlinePayments',
            'bankTransfers',
            'codPayments',
            'startDate',
            'endDate'
        ));
    }
}