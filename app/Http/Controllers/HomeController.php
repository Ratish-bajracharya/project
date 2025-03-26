<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featuredProducts = Product::where('featured', true)
            ->with(['category', 'brand'])
            ->withCount('reviews')
            ->take(8)
            ->get();
        
        return view('home', compact('featuredProducts'));
    }
    
    /**
     * Display the about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('about');
    }
    
    /**
     * Display the contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('contact');
    }
    
    /**
     * Process the contact form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        // Process contact form (send email, save to database, etc.)
        // This would be implemented in a real application
        
        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
    
    /**
     * Display the FAQ page.
     *
     * @return \Illuminate\Http\Response
     */
    public function faq()
    {
        return view('faq');
    }
    
    /**
     * Display the terms of service page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        return view('terms');
    }
    
    /**
     * Display the privacy policy page.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {
        return view('privacy');
    }
    
    /**
     * Display the shipping policy page.
     *
     * @return \Illuminate\Http\Response
     */
    public function shipping()
    {
        return view('shipping');
    }
    
    /**
     * Display the returns policy page.
     *
     * @return \Illuminate\Http\Response
     */
    public function returns()
    {
        return view('returns');
    }
    
    /**
     * Subscribe to the newsletter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);
        
        // Process newsletter subscription (add to mailing list, etc.)
        // This would be implemented in a real application
        
        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}

