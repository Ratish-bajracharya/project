@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-8">Shopping Cart</h1>
    
    @if(Cart::count() > 0)
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold mb-4">Cart Items ({{ Cart::count() }})</h2>
                        
                        <div class="divide-y">
                            @foreach(Cart::content() as $item)
                                <div class="py-4 flex flex-col sm:flex-row">
                                    <div class="sm:w-24 sm:h-24 flex-shrink-0 mb-4 sm:mb-0">
                                        <img src="{{ $item->model->featured_image }}" alt="{{ $item->name }}" class="w-full h-full object-cover rounded-md">
                                    </div>
                                    <div class="flex-1 sm:ml-4">
                                        <div class="flex flex-col sm:flex-row sm:justify-between">
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $item->name }}</h3>
                                                <p class="text-gray-600 text-sm">{{ $item->model->brand->name }}</p>
                                                
                                                @if($item->options->has('attributes'))
                                                    <div class="text-sm text-gray-500 mt-1">
                                                        @foreach($item->options->attributes as $attribute => $value)
                                                            <span>{{ $attribute }}: {{ $value }}</span>
                                                            @if(!$loop->last), @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mt-2 sm:mt-0 text-right">
                                                <span class="font-semibold">${{ number_format($item->price, 2) }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-4">
                                            <div class="flex items-center border rounded-md">
                                                <form action="{{ route('cart.decrease', $item->rowId) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1 text-gray-600 hover:bg-gray-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                <span class="px-3 py-1">{{ $item->qty }}</span>
                                                <form action="{{ route('cart.increase', $item->rowId) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1 text-gray-600 hover:bg-gray-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                            
                                            <div class="flex items-center mt-3 sm:mt-0">
                                                <span class="font-semibold mr-4">${{ number_format($item->price * $item->qty, 2) }}</span>
                                                <form action="{{ route('cart.remove', $item->rowId) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-between">
                    <a href="{{ route('products.index') }}" class="flex items-center text-primary hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Continue Shopping
                    </a>
                    
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Clear Cart
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                    <h2 class="text-lg font-semibold mb-4">Order Summary</h2>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span>${{ number_format(Cart::subtotal(), 2) }}</span>
                        </div>
                        
                        @if(session()->has('coupon'))
                            <div class="flex justify-between">
                                <span class="text-gray-600">Discount ({{ session()->get('coupon')['name'] }})</span>
                                <span class="text-red-500">-${{ number_format(session()->get('coupon')['discount'], 2) }}</span>
                            </div>
                        @endif
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax ({{ config('cart.tax') }}%)</span>
                            <span>${{ number_format(Cart::tax(), 2) }}</span>
                        </div>
                        
                        <div class="border-t pt-4 flex justify-between font-semibold">
                            <span>Total</span>
                            <span>${{ number_format(Cart::total(), 2) }}</span>
                        </div>
                    </div>
                    
                    @if(!session()->has('coupon'))
                        <div class="mt-6">
                            <form action="{{ route('coupon.apply') }}" method="POST" class="flex">
                                @csrf
                                <input 
                                    type="text" 
                                    name="coupon_code" 
                                    placeholder="Coupon Code" 
                                    class="flex-1 rounded-l-md border-gray-300 focus:border-primary focus:ring-primary"
                                >
                                <button type="submit" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-r-md hover:bg-gray-300 transition-colors">
                                    Apply
                                </button>
                            </form>
                        </div>
                    @endif
                    
                    <div class="mt-6">
                        <a href="{{ route('checkout.index') }}" class="block w-full bg-primary text-white text-center px-4 py-3 rounded-md hover:bg-primary-dark transition-colors">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h2 class="text-xl font-semibold mb-2">Your cart is empty</h2>
            <p class="text-gray-600 mb-6">Looks like you haven't added any products to your cart yet.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-md hover:bg-primary-dark transition-colors">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection

