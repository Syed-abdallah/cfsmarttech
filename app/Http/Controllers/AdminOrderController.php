<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Barryvdh\DomPDF\Facade\Pdf;
class AdminOrderController extends Controller
{
   public function __construct()
    {
        $this->middleware('permission:create order')->only('create');
        $this->middleware('permission:view order')->only('index');
        $this->middleware('permission:show order')->only('show');
        $this->middleware('permission:edit order')->only('edit');
        $this->middleware('permission:update order')->only('update');
        $this->middleware('permission:view order invoice')->only('invoice');
        $this->middleware('permission:update order status')->only('updateStatus');
  
    }

   public function index(Request $request)
{
    $startDate = $request->input('start_date')
        ? Carbon::parse($request->input('start_date'))->startOfDay()
        : Carbon::now()->subDays(30);

    $endDate = $request->input('end_date')
        ? Carbon::parse($request->input('end_date'))->endOfDay()
        : Carbon::now();

    $orders = Order::with(['items', 'customer'])
        ->whereBetween('created_at', [$startDate, $endDate])
        ->orderBy('created_at', 'desc')
        ->paginate(15)
        ->appends($request->only(['start_date', 'end_date'])); // keeps filters on pagination

    return view('admin.orders.index', compact('orders'));
}

    public function show($id)
    {
        // Fetch order details
        $order = Order::with(['user', 'items.product'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
    public function invoice($order_number)
    {
        $order = \App\Models\Order::where('order_number', $order_number)->firstOrFail();


        $pdf = $this->generateInvoice($order);
        return $pdf->download("invoice-{$order->order_number}.pdf");
    }

    private function generateInvoice($order)
    {
        return Pdf::loadView('admin.orders.invoice', compact('order'));
    }


        public function adminshow($order_number)
    {
    
        
        $order = Order::with(['items', 'customer'])
                    ->where('order_number', $order_number)
                    ->firstOrFail();
        
        $shippingAddress = json_decode($order->shipping_address, true);
        
        return view('admin.orders.show', compact('order', 'shippingAddress'));
    }


public function updateStatus(Request $request)
{
    try {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);

        $order = Order::findOrFail($validated['order_id']);
        $order->status = $validated['status'];
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);

    } catch (\Exception $e) {
        \Log::error('Order status update failed: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error updating status: ' . $e->getMessage()
        ], 500);
    }
}
}
