<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RentalPackage;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display the rental page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rentals.index');
    }
    
    /**
     * Display the rental booking page.
     *
     * @param  string|null  $package
     * @return \Illuminate\Http\Response
     */
    public function book($package = null)
    {
        $rentalPackage = null;
        
        if ($package) {
            $rentalPackage = RentalPackage::where('slug', $package)->first();
        }
        
        $packages = RentalPackage::all();
        
        return view('rentals.book', compact('rentalPackage', 'packages'));
    }
    
    /**
     * Process the rental booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processBooking(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:rental_packages,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:2',
            'event_type' => 'required|string|max:255',
            'event_location' => 'required|string|max:255',
            'setup_required' => 'boolean',
            'technician_required' => 'boolean',
        ]);
        
        // Calculate rental duration in days
        $startDate = new \DateTime($request->start_date);
        $endDate = new \DateTime($request->end_date);
        $duration = $startDate->diff($endDate)->days + 1; // Include both start and end days
        
        // Get the package
        $package = RentalPackage::findOrFail($request->package_id);
        
        // Calculate base price
        $basePrice = $package->daily_rate * $duration;
        
        // Add additional services
        $additionalServices = 0;
        
        if ($request->setup_required) {
            $additionalServices += $package->setup_fee;
        }
        
        if ($request->technician_required) {
            $additionalServices += $package->technician_fee * $duration;
        }
        
        // Create rental
        $rental = new Rental();
        $rental->user_id = auth()->check() ? auth()->id() : null;
        $rental->rental_number = 'RNT-' . strtoupper(uniqid());
        $rental->rental_package_id = $package->id;
        $rental->start_date = $request->start_date;
        $rental->end_date = $request->end_date;
        $rental->duration = $duration;
        $rental->base_price = $basePrice;
        $rental->additional_services = $additionalServices;
        $rental->total_price = $basePrice + $additionalServices;
        $rental->status = 'pending';
        $rental->payment_status = 'pending';
        
        // Customer information
        $rental->first_name = $request->first_name;
        $rental->last_name = $request->last_name;
        $rental->email = $request->email;
        $rental->phone = $request->phone;
        $rental->address = $request->address;
        $rental->city = $request->city;
        $rental->state = $request->state;
        $rental->postal_code = $request->postal_code;
        $rental->country = $request->country;
        
        // Event information
        $rental->event_type = $request->event_type;
        $rental->event_location = $request->event_location;
        $rental->setup_required = $request->has('setup_required');
        $rental->technician_required = $request->has('technician_required');
        $rental->notes = $request->notes;
        
        $rental->save();
        
        // Redirect to payment page
        return redirect()->route('rentals.payment', $rental->rental_number);
    }
    
    /**
     * Display the rental payment page.
     *
     * @param  string  $rentalNumber
     * @return \Illuminate\Http\Response
     */
    public function payment($rentalNumber)
    {
        $rental = Rental::where('rental_number', $rentalNumber)->firstOrFail();
        
        return view('rentals.payment', compact('rental'));
    }
    
    /**
     * Process the rental payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $rentalNumber
     * @return \Illuminate\Http\Response
     */
    public function processPayment(Request $request, $rentalNumber)
    {
        $rental = Rental::where('rental_number', $rentalNumber)->firstOrFail();
        
        $request->validate([
            'payment_method' => 'required|in:credit_card,paypal',
        ]);
        
        // Process payment (this would integrate with a payment gateway in a real application)
        // For demonstration purposes, we'll assume the payment was successful
        
        $rental->payment_status = 'paid';
        $rental->payment_method = $request->payment_method;
        $rental->save();
        
        return redirect()->route('rentals.confirmation', $rental->rental_number);
    }
    
    /**
     * Display the rental confirmation page.
     *
     * @param  string  $rentalNumber
     * @return \Illuminate\Http\Response
     */
    public function confirmation($rentalNumber)
    {
        $rental = Rental::where('rental_number', $rentalNumber)->firstOrFail();
        
        return view('rentals.confirmation', compact('rental'));
    }
    
    /**
     * Display the custom rental quote page.
     *
     * @return \Illuminate\Http\Response
     */
    public function custom()
    {
        return view('rentals.custom');
    }
    
    /**
     * Process the custom rental quote request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processCustom(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'event_type' => 'required|string|max:255',
            'event_date' => 'required|date|after_or_equal:today',
            'event_location' => 'required|string|max:255',
            'attendees' => 'required|integer|min:1',
            'requirements' => 'required|string',
        ]);
        
        // Process custom quote request (send email, save to database, etc.)
        // This would be implemented in a real application
        
        return redirect()->route('rentals.custom.success');
    }
    
    /**
     * Display the custom rental quote success page.
     *
     * @return \Illuminate\Http\Response
     */
    public function customSuccess()
    {
        return view('rentals.custom-success');
    }
}

