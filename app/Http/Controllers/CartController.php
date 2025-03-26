<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display the cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
    }
    
    /**
     * Add a product to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        
        $options = [];
        
        // Check if product has attributes (like color, size, etc.)
        if ($request->has('attributes')) {
            $options['attributes'] = $request->attributes;
        }
        
        // Check if it's a rental
        if ($request->has('is_rental') && $request->is_rental) {
            $options['is_rental'] = true;
            $options['rental_start'] = $request->rental_start;
            $options['rental_end'] = $request->rental_end;
        }
        
        Cart::add(
            $product->id,
            $product->name,
            $request->quantity,
            $product->discount_price ?? $product->price,
            $options
        )->associate('App\Models\Product');
        
        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }
    
    /**
     * Update the quantity of a cart item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $rowId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        Cart::update($rowId, $request->quantity);
        
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }
    
    /**
     * Increase the quantity of a cart item by one.
     *
     * @param  string  $rowId
     * @return \Illuminate\Http\Response
     */
    public function increase($rowId)
    {
        $item = Cart::get($rowId);
        Cart::update($rowId, $item->qty + 1);
        
        return redirect()->route('cart.index')->with('success', 'Item quantity increased!');
    }
    
    /**
     * Decrease the quantity of a cart item by one.
     *
     * @param  string  $rowId
     * @return \Illuminate\Http\Response
     */
    public function decrease($rowId)
    {
        $item = Cart::get($rowId);
        
        if ($item->qty > 1) {
            Cart::update($rowId, $item->qty - 1);
            $message = 'Item quantity decreased!';
        } else {
            Cart::remove($rowId);
            $message = 'Item removed from cart!';
        }
        
        return redirect()->route('cart.index')->with('success', $message);
    }
    
    /**
     * Remove an item from the cart.
     *
     * @param  string  $rowId
     * @return \Illuminate\Http\Response
     */
    public function remove($rowId)
    {
        Cart::remove($rowId);
        
        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }
    
    /**
     * Clear the cart.
     *
     * @return \Illuminate
\Http\Response
     */
    public function clear()
    {
        Cart::destroy();
        
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }
}

