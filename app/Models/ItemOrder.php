<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'price',
        'quantity',
        'is_rental',
        'rental_start',
        'rental_end',
    ];
    
    protected $casts = [
        'is_rental' => 'boolean',
        'rental_start' => 'date',
        'rental_end' => 'date',
    ];
    
    /**
     * Get the order that owns the item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    /**
     * Get the product that owns the item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    /**
     * Get the subtotal for the item.
     */
    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}

