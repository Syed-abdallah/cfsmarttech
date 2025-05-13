<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;




class OrderController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function index()
{
    $customer_id = Auth::guard('customer')->id();
    $orders = Order::where('user_id', $customer_id)
                ->withCount('items')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

    return view('customer.dashboard.orders.index', compact('orders'));
}

//   public function show($id)
//     {
     
//         $order = Order::with(['user', 'items.product'])->findOrFail($id);
// dd($order);
//         return view('cfcustomer.customer.orders.show', compact('order'));
//     }
    public function store(Request $request)
    {
        
        $request->validate([
            'payment_method' => 'required|string',
            'payment_slip' => 'required_if:payment_method,bank_transfer|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'shipping_address_id' => 'required|exists:customer_addresses,id',
        ]);

        $cart = json_decode($request->input('cart'), true);
        $address = Auth::user()->addresses()->findOrFail($request->shipping_address_id);

        // Calculate totals
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $tax = 0;
        $shipping = $subtotal > 0 ? config('app.shipping_charge', 0) : 0;
        $total = $subtotal + $tax + $shipping;

        // Handle payment slip upload
        $paymentSlipPath = null;
        if ($request->hasFile('payment_slip')) {
            $paymentSlipPath = $request->file('payment_slip')->store('payment_slips', 'public');
        }

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . Str::upper(Str::random(8)),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
            'payment_method' => $request->payment_method,
            'payment_slip' => $paymentSlipPath,
            'status' => 'pending',
            'shipping_address' => json_encode($address),
        ]);

        // Create order items and update stock
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);

            // Update product stock
            $product = Product::find($item['id']);
            $product->quantity -= $item['quantity'];
            $product->save();
        }

        // Clear cart
        $request->session()->forget('cart');

        return response()->json([
            'success' => true,
            'order_id' => $order->id,
            'message' => 'Order placed successfully!'
        ]);
    }

   
    /**
     * Cancel an order (if allowed)
     */
    public function cancel($order_number)
    {
        $order = Auth::guard('customer')->user()->orders()
                    ->where('order_number', $order_number)
                    ->whereIn('status', ['pending', 'processing'])
                    ->firstOrFail();

        $order->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Order has been cancelled successfully');
    }

    /**
     * Track order status
     */
    public function track($order_number)
    {
        $order = Auth::guard('customer')->user()->orders()
                    ->where('order_number', $order_number)
                    ->firstOrFail();

        return view('customer.dashboard.orders.track', compact('order'));
    }

    /**
     * Download invoice
     */
 public function invoice($order_number)
    {
        $order = Auth::guard('customer')->user()->orders()
                    ->where('order_number', $order_number)
                    ->firstOrFail();

        $pdf = $this->generateInvoice($order);
        return $pdf->download("invoice-{$order->order_number}.pdf");
    }

    private function generateInvoice($order)
    {
        return Pdf::loadView('customer.dashboard.orders.invoice', compact('order'));
    }
       public function show($order_number)
    {
    
        
        $order = Order::with(['items', 'customer'])
                    ->where('order_number', $order_number)
                    ->firstOrFail();
        
        $shippingAddress = json_decode($order->shipping_address, true);
        
        return view('admin.orders.show', compact('order', 'shippingAddress'));
    }
}