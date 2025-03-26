<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\RentalManagementController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home and static pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/shipping', [HomeController::class, 'shipping'])->name('shipping');
Route::get('/returns', [HomeController::class, 'returns'])->name('returns');
Route::post('/newsletter/subscribe', [HomeController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/category/{slug}', [ProductController::class, 'category'])->name('products.category');
Route::get('/products/brand/{slug}', [ProductController::class, 'brand'])->name('products.brand');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
Route::get('/products/compare', [ProductController::class, 'compare'])->name('products.compare');
Route::post('/products/compare/add/{id}', [ProductController::class, 'addToCompare'])->name('products.compare.add');
Route::delete('/products/compare/remove/{id}', [ProductController::class, 'removeFromCompare'])->name('products.compare.remove');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{rowId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/increase/{rowId}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{rowId}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/cart/mini', [CartController::class, 'mini'])->name('cart.mini');

// Wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{productId}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove/{productId}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::post('/wishlist/move-to-cart/{productId}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
Route::post('/wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');

// Coupon
Route::post('/coupon/apply', [CouponController::class, 'apply'])->name('coupon.apply');
Route::delete('/coupon/remove', [CouponController::class, 'remove'])->name('coupon.remove');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success/{orderNumber}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/failed', [CheckoutController::class, 'failed'])->name('checkout.failed');
Route::post('/checkout/validate-shipping', [CheckoutController::class, 'validateShipping'])->name('checkout.validateShipping');
Route::post('/checkout/calculate-shipping', [CheckoutController::class, 'calculateShipping'])->name('checkout.calculateShipping');
Route::get('/checkout/payment-methods', [CheckoutController::class, 'paymentMethods'])->name('checkout.paymentMethods');

// Rentals
Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
Route::get('/rentals/packages', [RentalController::class, 'packages'])->name('rentals.packages');
Route::get('/rentals/package/{slug}', [RentalController::class, 'showPackage'])->name('rentals.package.show');
Route::get('/rentals/book/{packageId?}', [RentalController::class, 'book'])->name('rentals.book');
Route::post('/rentals/book/process', [RentalController::class, 'processBooking'])->name('rentals.book.process');
Route::get('/rentals/confirmation/{rentalId}', [RentalController::class, 'confirmation'])->name('rentals.confirmation');
Route::get('/rentals/custom-quote', [RentalController::class, 'customQuote'])->name('rentals.customQuote');
Route::post('/rentals/custom-quote/submit', [RentalController::class, 'submitCustomQuote'])->name('rentals.customQuote.submit');
Route::get('/rentals/faq', [RentalController::class, 'faq'])->name('rentals.faq');
Route::get('/rentals/terms', [RentalController::class, 'terms'])->name('rentals.terms');

// Reviews
Route::post('/reviews/add/{productId}', [ReviewController::class, 'add'])->name('reviews.add');
Route::get('/reviews/product/{productId}', [ReviewController::class, 'productReviews'])->name('reviews.product');
Route::delete('/reviews/delete/{reviewId}', [ReviewController::class, 'delete'])->name('reviews.delete');
Route::post('/reviews/helpful/{reviewId}', [ReviewController::class, 'markHelpful'])->name('reviews.helpful');

// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// User Account
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [UserController::class, 'index'])->name('account.index');
    Route::get('/account/profile', [UserController::class, 'profile'])->name('account.profile');
    Route::post('/account/profile/update', [UserController::class, 'updateProfile'])->name('account.profile.update');
    Route::get('/account/orders', [UserController::class, 'orders'])->name('account.orders');
    Route::get('/account/orders/{orderNumber}', [UserController::class, 'orderDetails'])->name('account.orders.details');
    Route::get('/account/rentals', [UserController::class, 'rentals'])->name('account.rentals');
    Route::get('/account/rentals/{rentalId}', [UserController::class, 'rentalDetails'])->name('account.rentals.details');
    Route::get('/account/addresses', [UserController::class, 'addresses'])->name('account.addresses');
    Route::post('/account/addresses/add', [UserController::class, 'addAddress'])->name('account.addresses.add');
    Route::put('/account/addresses/update/{addressId}', [UserController::class, 'updateAddress'])->name('account.addresses.update');
    Route::delete('/account/addresses/delete/{addressId}', [UserController::class, 'deleteAddress'])->name('account.addresses.delete');
    Route::get('/account/password', [UserController::class, 'password'])->name('account.password');
    Route::post('/account/password/update', [UserController::class, 'updatePassword'])->name('account.password.update');
    Route::get('/account/reviews', [UserController::class, 'reviews'])->name('account.reviews');
});

// Orders
Route::get('/orders/track/{orderNumber}', [OrderController::class, 'track'])->name('orders.track');
Route::post('/orders/track', [OrderController::class, 'trackSubmit'])->name('orders.track.submit');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Product Management
    Route::get('/products', [ProductManagementController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductManagementController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [ProductManagementController::class, 'store'])->name('admin.products.store');
    Route::get('/products/edit/{id}', [ProductManagementController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/update/{id}', [ProductManagementController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/delete/{id}', [ProductManagementController::class, 'delete'])->name('admin.products.delete');
    Route::get('/products/categories', [ProductManagementController::class, 'categories'])->name('admin.products.categories');
    Route::post('/products/categories/store', [ProductManagementController::class, 'storeCategory'])->name('admin.products.categories.store');
    Route::put('/products/categories/update/{id}', [ProductManagementController::class, 'updateCategory'])->name('admin.products.categories.update');
    Route::delete('/products/categories/delete/{id}', [ProductManagementController::class, 'deleteCategory'])->name('admin.products.categories.delete');
    Route::get('/products/brands', [ProductManagementController::class, 'brands'])->name('admin.products.brands');
    Route::post('/products/brands/store', [ProductManagementController::class, 'storeBrand'])->name('admin.products.brands.store');
    Route::put('/products/brands/update/{id}', [ProductManagementController::class, 'updateBrand'])->name('admin.products.brands.update');
    Route::delete('/products/brands/delete/{id}', [ProductManagementController::class, 'deleteBrand'])->name('admin.products.brands.delete');
    
    // Order Management
    Route::get('/orders', [OrderManagementController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/view/{id}', [OrderManagementController::class, 'view'])->name('admin.orders.view');
    Route::put('/orders/update-status/{id}', [OrderManagementController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::post('/orders/add-tracking/{id}', [OrderManagementController::class, 'addTracking'])->name('admin.orders.addTracking');
    Route::delete('/orders/delete/{id}', [OrderManagementController::class, 'delete'])->name('admin.orders.delete');
    
    // User Management
    Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [UserManagementController::class, 'store'])->name('admin.users.store');
    Route::get('/users/edit/{id}', [UserManagementController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/update/{id}', [UserManagementController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/delete/{id}', [UserManagementController::class, 'delete'])->name('admin.users.delete');
    
    // Rental Management
    Route::get('/rentals', [RentalManagementController::class, 'index'])->name('admin.rentals.index');
    Route::get('/rentals/view/{id}', [RentalManagementController::class, 'view'])->name('admin.rentals.view');
    Route::put('/rentals/update-status/{id}', [RentalManagementController::class, 'updateStatus'])->name('admin.rentals.updateStatus');
    Route::get('/rentals/packages', [RentalManagementController::class, 'packages'])->name('admin.rentals.packages');
    Route::get('/rentals/packages/create', [RentalManagementController::class, 'createPackage'])->name('admin.rentals.packages.create');
    Route::post('/rentals/packages/store', [RentalManagementController::class, 'storePackage'])->name('admin.rentals.packages.store');
    Route::get('/rentals/packages/edit/{id}', [RentalManagementController::class, 'editPackage'])->name('admin.rentals.packages.edit');
    Route::put('/rentals/packages/update/{id}', [RentalManagementController::class, 'updatePackage'])->name('admin.rentals.packages.update');
    Route::delete('/rentals/packages/delete/{id}', [RentalManagementController::class, 'deletePackage'])->name('admin.rentals.packages.delete');
    Route::get('/rentals/custom-quotes', [RentalManagementController::class, 'customQuotes'])->name('admin.rentals.customQuotes');
    Route::get('/rentals/custom-quotes/view/{id}', [RentalManagementController::class, 'viewCustomQuote'])->name('admin.rentals.customQuotes.view');
    Route::post('/rentals/custom-quotes/respond/{id}', [RentalManagementController::class, 'respondCustomQuote'])->name('admin.rentals.customQuotes.respond');
    
    // Coupon Management
    Route::get('/coupons', [CouponController::class, 'adminIndex'])->name('admin.coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('admin.coupons.create');
    Route::post('/coupons/store', [CouponController::class, 'store'])->name('admin.coupons.store');
    Route::get('/coupons/edit/{id}', [CouponController::class, 'edit'])->name('admin.coupons.edit');
    Route::put('/coupons/update/{id}', [CouponController::class, 'update'])->name('admin.coupons.update');
    Route::delete('/coupons/delete/{id}', [CouponController::class, 'delete'])->name('admin.coupons.delete');
    
    // Settings
    Route::get('/settings', [DashboardController::class, 'settings'])->name('admin.settings');
    Route::post('/settings/update', [DashboardController::class, 'updateSettings'])->name('admin.settings.update');
    
    // Reports
    Route::get('/reports/sales', [DashboardController::class, 'salesReport'])->name('admin.reports.sales');
    Route::get('/reports/products', [DashboardController::class, 'productsReport'])->name('admin.reports.products');
    Route::get('/reports/customers', [DashboardController::class, 'customersReport'])->name('admin.reports.customers');
    Route::get('/reports/rentals', [DashboardController::class, 'rentalsReport'])->name('admin.reports.rentals');
    Route::get('/reports/export/{type}', [DashboardController::class, 'exportReport'])->name('admin.reports.export');
});

// Fallback route
Route::fallback(function () {
    return view('errors.404');
});

require __DIR__ . '/web.php';
