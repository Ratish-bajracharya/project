<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'features',
        'specifications',
        'price',
        'discount_price',
        'stock_quantity',
        'sku',
        'featured',
        'rating',
        'category_id',
        'brand_id',
    ];
    
    protected $casts = [
        'features' => 'array',
        'specifications' => 'array',
        'featured' => 'boolean',
    ];
    
    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    /**
     * Get the brand that owns the product.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    
    /**
     * Get the reviews for the product.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    /**
     * Get the images for the product.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    /**
     * Get the featured image for the product.
     */
    public function getFeaturedImageAttribute()
    {
        $featuredImage = $this->images()->where('is_featured', true)->first();
        
        if ($featuredImage) {
            return $featuredImage->image_path;
        }
        
        // Return a default image if no featured image is found
        return asset('images/product-placeholder.jpg');
    }
    
    /**
     * Get related products.
     */
    public function related()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id')
            ->where('id', '!=', $this->id)
            ->take(4);
    }
    
    /**
     * Scope a query to only include featured products.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
    
    /**
     * Scope a query to only include products on sale.
     */
    public function scopeOnSale($query)
    {
        return $query->whereNotNull('discount_price');
    }
    
    /**
     * Scope a query to only include in-stock products.
     */
    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }
    
    /**
     * Check if the product is on sale.
     */
    public function getIsOnSaleAttribute()
    {
        return $this->discount_price !== null;
    }
    
    /**
     * Get the discount percentage.
     */
    public function getDiscountPercentageAttribute()
    {
        if ($this->is_on_sale) {
            return round((($this->price - $this->discount_price) / $this->price) * 100);
        }
        
        return 0;
    }
}

