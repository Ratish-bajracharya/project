@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Sound System Rentals</h1>
        
        <!-- Rental Hero Section -->
        <div class="bg-gray-100 rounded-lg overflow-hidden mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="p-8 flex flex-col justify-center">
                    <h2 class="text-2xl font-bold mb-4">Professional Sound Equipment for Any Event</h2>
                    <p class="text-gray-600 mb-6">Whether you're hosting a small gathering or a large-scale event, we have the perfect sound system for your needs. Our rental equipment is professionally maintained and comes with setup assistance.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Flexible rental periods (daily, weekly, monthly)
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Professional setup and teardown available
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            On-site technical support
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Delivery and pickup services
                        </li>
                    </ul>
                    <a href="#rental-packages" class="bg-primary text-white px-6 py-3 rounded-md inline-block hover:bg-primary-dark transition-colors">
                        View Rental Packages
                    </a>
                </div>
                <div>
                    <img src="{{ asset('images/rental-hero.jpg') }}" alt="Sound System Rental" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
        
        <!-- How It Works -->
        <div class="mb-16">
            <h2 class="text-2xl font-bold mb-8 text-center">How Renting Works</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">1. Choose Your Dates</h3>
                    <p class="text-gray-600">Select the rental period that works for your event. We offer daily, weekly, and monthly options.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">2. Select Your Equipment</h3>
                    <p class="text-gray-600">Browse our packages or customize your own setup based on your specific needs.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">3. Confirm and Enjoy</h3>
                    <p class="text-gray-600">We'll deliver, set up, and ensure everything is working perfectly for your event.</p>
                </div>
            </div>
        </div>
        
        <!-- Rental Packages -->
        <div id="rental-packages" class="mb-16">
            <h2 class="text-2xl font-bold mb-8 text-center">Rental Packages</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Small Event Package -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Small Event Package</h3>
                        <p class="text-gray-600 mb-4">Perfect for gatherings of up to 50 people</p>
                        
                        <div class="mb-6">
                            <span class="text-3xl font-bold">$199</span>
                            <span class="text-gray-600">/day</span>
                        </div>
                        
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                2 Powered Speakers (12")
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                1 Subwoofer
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                1 Mixer (8-channel)
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                2 Wireless Microphones
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                All Necessary Cables & Stands
                            </li>
                        </ul>
                        
                        <a href="{{ route('rentals.book', 'small') }}" class="block w-full bg-primary text-white text-center px-4 py-2 rounded-md hover:bg-primary-dark transition-colors">
                            Book Now
                        </a>
                    </div>
                </div>
                
                <!-- Medium Event Package -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border-2 border-primary">
                    <div class="bg-primary text-white py-2 text-center">
                        <span class="font-semibold">Most Popular</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Medium Event Package</h3>
                        <p class="text-gray-600 mb-4">Ideal for events with 50-150 people</p>
                        
                        <div class="mb-6">
                            <span class="text-3xl font-bold">$349</span>
                            <span class="text-gray-600">/day</span>
                        </div>
                        
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                4 Powered Speakers (15")
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                2 Subwoofers
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                1 Digital Mixer (16-channel)
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                4 Wireless Microphones
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Basic Lighting Package
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                All Necessary Cables & Stands
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                On-site Technician (4 hours)
                            </li>
                        </ul>
                        
                        <a href="{{ route('rentals.book', 'medium') }}" class="block w-full bg-primary text-white text-center px-4 py-2 rounded-md hover:bg-primary-dark transition-colors">
                            Book Now
                        </a>
                    </div>
                </div>
                
                <!-- Large Event Package -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Large Event Package</h3>
                        <p class="text-gray-600 mb-4">For events with 150-300+ people</p>
                        
                        <div class="mb-6">
                            <span class="text-3xl font-bold">$599</span>
                            <span class="text-gray-600">/day</span>
                        </div>
                        
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                6 Powered Speakers (15")
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                4 Subwoofers
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                1 Professional Digital Mixer (32-channel)
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                8 Wireless Microphones
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Complete Lighting Package
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                All Necessary Cables & Stands
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                2 On-site Technicians (full event)
                            </li>
                        </ul>
                        
                        <a href="{{ route('rentals.book', 'large') }}" class="block w-full bg-primary text-white text-center px-4 py-2 rounded-md hover:bg-primary-dark transition-colors">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <p class="text-gray-600 mb-4">Need a custom solution? We can create a package tailored to your specific requirements.</p>
                <a href="{{ route('rentals.custom') }}" class="inline-block bg-white border border-primary text-primary px-6 py-3 rounded-md hover:bg-primary hover:text-white transition-colors">
                    Request Custom Quote
                </a>
            </div>
        </div>
        
        <!-- Rental FAQs -->
        <div class="mb-16">
            <h2 class="text-2xl font-bold mb-8 text-center">Frequently Asked Questions</h2>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="divide-y">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">What is included in the rental price?</h3>
                        <p class="text-gray-600">Our rental prices include the equipment listed in each package, delivery within 25 miles of our location, basic setup, and pickup. Additional services like extended setup, on-site technical support, and custom configurations are available for an additional fee.</p>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">How far in advance should I book my rental?</h3>
                        <p class="text-gray-600">We recommend booking at least 2-3 weeks in advance for small events, and 4-6 weeks for medium to large events, especially during peak seasons (summer months and holidays). For custom setups, additional lead time may be required.</p>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">What if I need to cancel or reschedule my rental?</h3>
                        <p class="text-gray-600">Cancellations made more than 7 days before the rental date will receive a full refund minus a 10% processing fee. Cancellations within 3-7 days will receive a 50% refund. Cancellations less than 3 days before the rental date are non-refundable. Rescheduling is available at no additional cost with at least 7 days' notice, subject to availability.</p>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Do you provide setup and teardown services?</h3>
                        <p class="text-gray-600">Yes, basic setup is included with all rentals. For more complex setups, sound checks, and full event technical support, we offer additional service packages. Our technicians can remain on-site throughout your event to ensure everything runs smoothly.</p>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">What happens if equipment malfunctions during my event?</h3>
                        <p class="text-gray-600">We thoroughly test all equipment before delivery, but in the rare case of a malfunction, we provide 24/7 emergency support. Our technicians will either resolve the issue remotely or dispatch a replacement immediately. We also offer optional equipment backup packages for critical events.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Call to Action -->
        <div class="bg-primary text-white rounded-lg p-8 text-center">
            <h2 class="text-2xl font-bold mb-4">Ready to Book Your Sound System?</h2>
            <p class="mb-6 max-w-2xl mx-auto">Contact our rental team today to discuss your event needs and secure the perfect sound equipment for your occasion.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('rentals.book') }}" class="bg-white text-primary px-6 py-3 rounded-md hover:bg-gray-100 transition-colors">
                    Book Now
                </a>
                <a href="{{ route('contact') }}" class="bg-transparent border border-white text-white px-6 py-3 rounded-md hover:bg-white/10 transition-colors">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

