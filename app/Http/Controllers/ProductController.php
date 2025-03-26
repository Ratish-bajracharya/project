<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::query();
        
        // Filter by categories
        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->categories);
        }
        
        // Filter by brands
        if ($request->has('brands')) {
            $query->whereIn('brand_id', $request->brands);
        }
        
        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Filter by availability
        if ($request->has('in_stock')) {
            $query->where('stock_quantity', '>', 0);
        }
        
        // Filter by sale items
        if ($request->has('on_sale')) {
            $query->whereNotNull('discount_price');
        }
        
        // Filter by ratings
        if ($request->has('ratings')) {
            $query->whereIn('rating', $request->ratings);
        }
        
        // Sort products
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                default:
                    $query->where('featured', true)->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->where('featured', true)->orderBy('created_at', 'desc');
        }
        
        $products = $query->with(['category', 'brand'])->withCount('reviews')->paginate(12);
        $categories = Category::all();
        $brands = Brand::all();
        
        return view('products.index', compact('products', 'categories', 'brands'));
    }
    
    /**
     * Display products by category.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->with(['category', 'brand'])
            ->withCount('reviews')
            ->paginate(12);
        $categories = Category::all();
        $brands = Brand::all();
        
        return view('products.index', compact('products', 'categories', 'brands', 'category'));
    }
    
    /**
     * Display the specified product.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(['category', 'brand', 'reviews.user', 'related'])
            ->firstOrFail();
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }
    
    /**
     * Search for products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orWhereHas('category', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orWhereHas('brand', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->with(['category', 'brand'])
            ->withCount('reviews')
            ->paginate(12);
        
        return view('products.search', compact('products', 'query'));
    }
}

