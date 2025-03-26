@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Sign In</h2>
            
            @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-md mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                        required 
                        autofocus
                    >
                </div>
                
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full rounded-md border-gray-300 focus:border-primary focus:ring-primary"
                        required
                    >
                </div>
                
                <div class="flex items-center justify-between mb-6">
                    <label class="inline-flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            class="rounded border-gray-300 text-primary focus:ring-primary"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <span class="ml-2 text-sm text-gray-600">Remember Me</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
                            Forgot Your Password?
                        </a>
                    @endif
                </div>
                
                <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-primary-dark transition-colors">
                    Sign In
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-primary hover:underline">
                        Sign Up
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

