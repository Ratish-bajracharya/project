<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'rental_number',
        'rental_package_id',
        'start_date',
        'end_date',
        'duration',
        'base_price',
        'additional_services',
        'total_price',
        'status',
        'payment_status',
        'payment_method',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'event_type',
        'event_location',
        'setup_required',
        'technician_required',
        'notes',
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'setup_required' => 'boolean',
        'technician_required' => 'boolean',
    ];
    
    /**
     * Get the user that owns the rental.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the package that owns the rental.
     */
    public function package()
    {
        return $this->belongsTo(RentalPackage::class, 'rental_package_id');
    }
    
    /**
     * Get the customer's full name.
     */
    public function getCustomerNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    /**
     * Get the customer's full address.
     */
    public function getFullAddressAttribute()
    {
        return $this->address . ', ' . $this->city . ', ' . $this->state . ' ' . $this->postal_code . ', ' . $this->country;
    }
}

