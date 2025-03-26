<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        return view('checkout.index');
    }
    
    /**
     * Process the checkout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:2',
            'payment_method' => 'required|in:credit_card,paypal',
        ]);
        
        // Process payment (this would integrate with a payment gateway in a real application)
        // For demonstration purposes, we'll assume the payment was successful
        
        // Create order
        $order = new Order();
        $order->user_id = auth()->check() ? auth()->id() : null;
        $order->order_number = 'ORD-' . strtoupper(uniqid());
        $order->status = 'pending';
        $order->payment_status = 'paid';
        $order->payment_method = $request->payment_method;
        
        // Shipping information
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->postal_code = $request->postal_code;
        $order->country = $request->country;
        
        // Order totals
        $order->subtotal = Cart::subtotal();
        $order->tax = Cart::tax();
        
        // Add shipping cost based on selected method
        switch ($request->shipping_method) {
            case 'express':
                $shipping = 12.99;
                break;
            case 'overnight':
                $shipping = 24.99;
                break;
            default:
                $shipping = 5.99;
                break;
        }
        
        $order->shipping = $shipping;
        
        // Apply discount if coupon is used
        if (session()->has('coupon')) {
            $order->discount = session()->get('coupon')['discount'];
            $order->coupon_code = session()->get('coupon')['name'];
        } else {
            $order->discount = 0;
            $order->coupon_code = null;
        }
        
        $order->total = Cart::total() + $shipping;
        $order->notes = $request->notes;
        $order->save();
        
        // Create order items
        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->model->id;
            $orderItem->name = $item->name;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            
            // Check if it's a rental
            if (isset($item->options['is_rental']) && $item->options['is_rental']) {
                $orderItem->is_rental = true;
                $orderItem->rental_start = $item->options['rental_start'];
                $orderItem->rental_end = $item->options['rental_end'];
            }
            
            $orderItem->save();
        }
        
        // Clear cart and coupon
        Cart::destroy();
        session()->forget('coupon');
        
        // Save user information if requested
        if (auth()->check() && $request->has('save_info')) {
            $user = auth()->user();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->postal_code = $request->postal_code;
            $user->country = $request->country;
            $user->save();
        }
        
        return redirect()->route('checkout.success', $order->order_number);
    }
    
    /**
     * Display the checkout success page.
     *
     * @param  string  $orderNumber
     * @return \Illuminate\Http\Response
     */
    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        
        return view('checkout.success', compact('order'));
    }
}

