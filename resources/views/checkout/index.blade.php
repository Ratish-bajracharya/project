@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-8">Checkout</h1>
    
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Checkout Form -->
        <div class="lg:w-2/3">
            <form action="{{ route('checkout.process') }}" method="POST" id="payment-form">
                @csrf
                
                <!-- Shipping Information -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Shipping Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input 
                                type="text" 
                                id="first_name" 
                                name="first_name" 
                                value="{{ auth()->check() ? auth()->user()->first_name : old('first_name') }}" 
                                class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                required
                            >
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input 
                                type="text" 
                                id="last_name" 
                                name="last_name" 
                                value="{{ auth()->check() ? auth()->user()->last_name : old('last_name') }}" 
                                class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                required
                            >
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ auth()->check() ? auth()->user()->email : old('email') }}" 
                                class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                required
                            >
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                value="{{ auth()->check() ? auth()->user()->phone : old('phone') }}" 
                                class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                required
                            >
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input 
                                type="text" 
                                id="address" 
                                name="address" 
                                value="{{ auth()->check() ? auth()->user()->address : old('address') }}" 
                                class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                required
                            >
                        </div>
                        
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                            <input 
                                type="text" 
                                id="city" 
                                name="city" 
                                value="{{ auth()->check() ? auth()->user()->city : old('city') }}" 
                                class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                required
                            >
                        </div>
                        
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                            <input 
                                type="text" 
                                id="state" 
                                name="state" 
                                value="{{ auth()->check() ? auth()->user()->state : old('state') }}" 
                                class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                required
                            >
                        </div>
                        
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                            <input 
                                type="text" 
                                id="postal_code" 
                                name="postal_code" 
                                value="{{ auth()->check() ? auth()->user()->postal_code : old('postal_code') }}" 
                                class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                required
                            >
                        </div>
                        
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                            <select 
                                id="country" 
                                name="country" 
                                class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                required
                            >
                                <option value="">Select Country</option>
                                <option value="US" {{ (auth()->check() && auth()->user()->country == 'US') || old('country') == 'US' ? 'selected' : '' }}>United States</option>
                                <option value="CA" {{ (auth()->check() && auth()->user()->country == 'CA') || old('country') == 'CA' ? 'selected' : '' }}>Canada</option>
                                <option value="GB" {{ (auth()->check() && auth()->user()->country == 'GB') || old('country') == 'GB' ? 'selected' : ''  {{ (auth()->check() && auth()->user()->country == 'GB') || old('country') == 'GB' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="AU" {{ (auth()->check() && auth()->user()->country == 'AU') || old('country') == 'AU' ? 'selected' : '' }}>Australia</option>
                                <option value="DE" {{ (auth()->check() && auth()->user()->country == 'DE') || old('country') == 'DE' ? 'selected' : '' }}>Germany</option>
                                <!-- Add more countries as needed -->
                            </select>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="inline-flex items-center">
                            <input 
                                type="checkbox" 
                                name="save_info" 
                                class="rounded border-gray-300 text-primary focus:ring-primary"
                                {{ auth()->check() ? 'checked' : '' }}
                            >
                            <span class="ml-2 text-sm text-gray-600">Save this information for next time</span>
                        </label>
                    </div>
                </div>
                
                <!-- Shipping Method -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Shipping Method</h2>
                    
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border rounded-md cursor-pointer hover:bg-gray-50">
                            <input 
                                type="radio" 
                                name="shipping_method" 
                                value="standard" 
                                class="text-primary focus:ring-primary" 
                                checked
                            >
                            <div class="ml-3">
                                <span class="block font-medium">Standard Shipping</span>
                                <span class="block text-sm text-gray-500">3-5 business days</span>
                            </div>
                            <span class="ml-auto font-medium">$5.99</span>
                        </label>
                        
                        <label class="flex items-center p-3 border rounded-md cursor-pointer hover:bg-gray-50">
                            <input 
                                type="radio" 
                                name="shipping_method" 
                                value="express" 
                                class="text-primary focus:ring-primary"
                            >
                            <div class="ml-3">
                                <span class="block font-medium">Express Shipping</span>
                                <span class="block text-sm text-gray-500">1-2 business days</span>
                            </div>
                            <span class="ml-auto font-medium">$12.99</span>
                        </label>
                        
                        <label class="flex items-center p-3 border rounded-md cursor-pointer hover:bg-gray-50">
                            <input 
                                type="radio" 
                                name="shipping_method" 
                                value="overnight" 
                                class="text-primary focus:ring-primary"
                            >
                            <div class="ml-3">
                                <span class="block font-medium">Overnight Shipping</span>
                                <span class="block text-sm text-gray-500">Next business day</span>
                            </div>
                            <span class="ml-auto font-medium">$24.99</span>
                        </label>
                    </div>
                </div>
                
                <!-- Payment Information -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Payment Information</h2>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                        <div class="flex space-x-4 mb-4">
                            <label class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="payment_method" 
                                    value="credit_card" 
                                    class="text-primary focus:ring-primary" 
                                    checked
                                >
                                <span class="ml-2">Credit Card</span>
                            </label>
                            <label class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="payment_method" 
                                    value="paypal" 
                                    class="text-primary focus:ring-primary"
                                >
                                <span class="ml-2">PayPal</span>
                            </label>
                        </div>
                    </div>
                    
                    <div id="credit-card-fields">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                                <input 
                                    type="text" 
                                    id="card_number" 
                                    name="card_number" 
                                    placeholder="1234 5678 9012 3456" 
                                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                >
                            </div>
                            
                            <div>
                                <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                                <input 
                                    type="text" 
                                    id="expiry_date" 
                                    name="expiry_date" 
                                    placeholder="MM/YY" 
                                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                >
                            </div>
                            
                            <div>
                                <label for="cvv" class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                <input 
                                    type="text" 
                                    id="cvv" 
                                    name="cvv" 
                                    placeholder="123" 
                                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                >
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="name_on_card" class="block text-sm font-medium text-gray-700 mb-1">Name on Card</label>
                                <input 
                                    type="text" 
                                    id="name_on_card" 
                                    name="name_on_card" 
                                    class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <div id="paypal-fields" class="hidden mt-4">
                        <p class="text-gray-600">You will be redirected to PayPal to complete your payment.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Order Notes</h2>
                    
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Additional Notes (Optional)</label>
                        <textarea 
                            id="notes" 
                            name="notes" 
                            rows="3" 
                            class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                            placeholder="Special instructions for delivery or any other notes"
                        ></textarea>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Order Summary -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                <h2 class="text-lg font-semibold mb-4">Order Summary</h2>
                
                <div class="max-h-64 overflow-y-auto mb-4">
                    @foreach(Cart::content() as $item)
                        <div class="flex py-3 {{ !$loop->last ? 'border-b' : '' }}">
                            <div class="w-16 h-16 flex-shrink-0">
                                <img src="{{ $item->model->featured_image }}" alt="{{ $item->name }}" class="w-full h-full object-cover rounded-md">
                            </div>
                            <div class="ml-4 flex-1">
                                <h4 class="font-medium">{{ $item->name }}</h4>
                                <div class="flex justify-between mt-1">
                                    <span class="text-sm text-gray-500">Qty: {{ $item->qty }}</span>
                                    <span>${{ number_format($item->price * $item->qty, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="space-y-3 border-t pt-3">
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
                        <span class="text-gray-600">Shipping</span>
                        <span id="shipping-cost">$5.99</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax ({{ config('cart.tax') }}%)</span>
                        <span>${{ number_format(Cart::tax(), 2) }}</span>
                    </div>
                    
                    <div class="border-t pt-3 flex justify-between font-semibold">
                        <span>Total</span>
                        <span id="order-total">${{ number_format(Cart::total() + 5.99, 2) }}</span>
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" form="payment-form" class="block w-full bg-primary text-white text-center px-4 py-3 rounded-md hover:bg-primary-dark transition-colors">
                        Place Order
                    </button>
                </div>
                
                <div class="mt-4 text-center text-sm text-gray-500">
                    <p>By placing your order, you agree to our <a href="{{ route('terms') }}" class="text-primary hover:underline">Terms of Service</a> and <a href="{{ route('privacy') }}" class="text-primary hover:underline">Privacy Policy</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
        const creditCardFields = document.getElementById('credit-card-fields');
        const paypalFields = document.getElementById('paypal-fields');
        
        // Toggle payment method fields
        paymentMethodRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'credit_card') {
                    creditCardFields.classList.remove('hidden');
                    paypalFields.classList.add('hidden');
                } else if (this.value === 'paypal') {
                    creditCardFields.classList.add('hidden');
                    paypalFields.classList.remove('hidden');
                }
            });
        });
        
        // Update shipping cost and total based on shipping method
        const shippingMethodRadios = document.querySelectorAll('input[name="shipping_method"]');
        const shippingCostElement = document.getElementById('shipping-cost');
        const orderTotalElement = document.getElementById('order-total');
        const subtotal = {{ Cart::subtotal() }};
        const tax = {{ Cart::tax() }};
        
        shippingMethodRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                let shippingCost = 5.99; // Default to standard shipping
                
                if (this.value === 'express') {
                    shippingCost = 12.99;
                } else if (this.value === 'overnight') {
                    shippingCost = 24.99;
                }
                
                shippingCostElement.textContent = '$' + shippingCost.toFixed(2);
                
                // Calculate new total
                @if(session()->has('coupon'))
                    const discount = {{ session()->get('coupon')['discount'] }};
                    const total = subtotal - discount + tax + shippingCost;
                @else
                    const total = subtotal + tax + shippingCost;
                @endif
                
                orderTotalElement.textContent = '$' + total.toFixed(2);
            });
        });
        
        // Basic form validation
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            
            if (paymentMethod === 'credit_card') {
                const cardNumber = document.getElementById('card_number').value;
                const expiryDate = document.getElementById('expiry_date').value;
                const cvv = document.getElementById('cvv').value;
                const nameOnCard = document.getElementById('name_on_card').value;
                
                if (!cardNumber || !expiryDate || !cvv || !nameOnCard) {
                    event.preventDefault();
                    alert('Please fill in all credit card details.');
                }
            }
        });
    });
</script>
@endpush
@endsection

