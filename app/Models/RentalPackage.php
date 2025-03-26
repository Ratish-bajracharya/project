<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalPackage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'daily_rate',
        'weekly_rate',
        'monthly_rate',
        'setup_fee',
        'technician_fee',
        'equipment',
        'image',
    ];
    
    protected $casts = [
        'equipment' => 'array',
    ];
    
    /**
     * Get the rentals for the package.
     */
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}

