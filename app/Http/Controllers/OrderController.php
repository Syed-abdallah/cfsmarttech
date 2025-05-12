<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
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
// return redirect()->route('frontend.carts');
        return response()->json([
            'success' => true,
            'order_id' => $order->id,
            'message' => 'Order placed successfully!'
        ]);
    }
}