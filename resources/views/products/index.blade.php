@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="w-full md:w-64 shrink-0">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                <h2 class="text-xl font-bold mb-4">Filters</h2>
                
                <form action="{{ route('products.index') }}" method="GET">
                    <!-- Categories -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-3">Categories</h3>
                        <div class="space-y-2">
                            @foreach($categories as $category)
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="category-{{ $category->id }}" 
                                    name="categories[]" 
                                    value="{{ $category->id }}"
                                    class="rounded border-gray-300 text-primary focus:ring-primary"
                                    {{ in_array($category->id, request()->input('categories', [])) ? 'checked' : '' }}
                                >
                                <label for="category-{{ $category->id }}" class="ml-2 text-sm">
                                    {{ $category->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Price Range -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-3">Price Range</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label for="min_price" class="text-sm text-gray-600">Min</label>
                                <input 
                                    type="number" 
                                    id="min_price" 
                                    name="min_price" 
                                    value="{{ request()->input('min_price') }}"
                                    class="w-full rounded-md border-gray-300 text-sm"
                                    min="0"
                                >
                            </div>
                            <div>
                                <label for="max_price" class="text-sm text-gray-600">Max</label>
                                <input 
                                    type="number" 
                                    id="max_price" 
                                    name="max_price" 
                                    value="{{ request()->input('max_price') }}"
                                    class="w-full rounded-md border-gray-300 text-sm"
                                    min="0"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <!-- Brands -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-3">Brands</h3>
                        <div class="space-y-2">
                            @foreach($brands as $brand)
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="brand-{{ $brand->id }}" 
                                    name="brands[]" 
                                    value="{{ $brand->id }}"
                                    class="rounded border-gray-300 text-primary focus:ring-primary"
                                    {{ in_array($brand->id, request()->input('brands', [])) ? 'checked' : '' }}
                                >
                                <label for="brand-{{ $brand->id }}" class="ml-2 text-sm">
                                    {{ $brand->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Availability -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-3">Availability</h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="in_stock" 
                                    name="in_stock" 
                                    value="1"
                                    class="rounded border-gray-300 text-primary focus:ring-primary"
                                    {{ request()->has('in_stock') ? 'checked' : '' }}
                                >
                                <label for="in_stock" class="ml-2 text-sm">
                                    In Stock
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="on_sale" 
                                    name="on_sale" 
                                    value="1"
                                    class="rounded border-gray-300 text-primary focus:ring-primary"
                                    {{ request()->has('on_sale') ? 'checked' : '' }}
                                >
                                <label for="on_sale" class="ml-2 text-sm">
                                    On Sale
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rating -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-3">Rating</h3>
                        <div class="space-y-2">
                            @for($i = 5; $i >= 1; $i--)
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="rating-{{ $i }}" 
                                    name="ratings[]" 
                                    value="{{ $i }}"
                                    class="rounded border-gray-300 text-primary focus:ring-primary"
                                    {{ in_array($i, request()->input('ratings', [])) ? 'checked' : '' }}
                                >
                                <label for="rating-{{ $i }}" class="ml-2 text-sm flex items-center">
                                    @for($j = 1; $j <= 5; $j++)
                                        @if($j <= $i)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                    @endfor
                                    <span class="ml-1">& Up</span>
                                </label>
                            </div>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark transition-colors">
                            Apply Filters
                        </button>
                        <a href="{{ route('products.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition-colors">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Product Grid -->
        <div class="flex-1">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <h1 class="text-2xl font-bold">All Products</h1>
                
                <div class="flex items-center mt-4 md:mt-0">
                    <label for="sort" class="mr-2 text-sm">Sort by:</label>
                    <select id="sort" name="sort" class="rounded-md border-gray-300 text-sm focus:border-primary focus:ring-primary" onchange="window.location.href=this.value">
                        <option value="{{ route('products.index', array_merge(request()->except('sort'), ['sort' => 'featured'])) }}" {{ request()->input('sort') == 'featured' ? 'selected' : '' }}>
                            Featured
                        </option>
                        <option value="{{ route('products.index', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" {{ request()->input('sort') == 'newest' ? 'selected' : '' }}>
                            Newest
                        </option>
                        <option value="{{ route('products.index', array_merge(request()->except('sort'), ['sort' => 'price_low'])) }}" {{ request()->input('sort') == 'price_low' ? 'selected' : '' }}>
                            Price: Low to High
                        </option>
                        <option value="{{ route('products.index', array_merge(request()->except('sort'), ['sort' => 'price_high'])) }}" {{ request()->input('sort') == 'price_high' ? 'selected' : '' }}>
                            Price: High to Low
                        </option>
                        <option value="{{ route('products.index', array_merge(request()->except('sort'), ['sort' => 'rating'])) }}" {{ request()->input('sort') == 'rating' ? 'selected' : '' }}>
                            Top Rated
                        </option>
                    </select>
                </div>
            </div>
            
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                        <a href="{{ route('products.show', $product) }}">
                            <img src="{{ $product->featured_image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <a href="{{ route('products.show', $product) }}" class="block">
                                <h3 class="text-lg font-semibold hover:text-primary transition-colors">{{ $product->name }}</h3>
                            </a>
                            <div class="flex items-center mt-2">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $product->rating)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-gray-500 text-sm ml-1">({{ $product->reviews_count }})</span>
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <div>
                                    @if($product->discount_price)
                                        <span class="text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                                        <span class="text-lg font-bold text-primary">${{ number_format($product->discount_price, 2) }}</span>
                                    @else
                                        <span class="text-lg font-bold">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-primary text-white p-2 rounded-full hover:bg-primary-dark transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-8">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-semibold mb-2">No products found</h3>
                    <p class="text-gray-600 mb-4">Try adjusting your filters or search criteria.</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark transition-colors">
                        Reset Filters
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

