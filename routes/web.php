<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Buyer\DashboardController as BuyerDashboard;
use App\Http\Controllers\Buyer\CatalogController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboard;
use App\Http\Controllers\Seller\ComponentController as SellerComponent;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\PCBuilderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SellerController as AdminSellerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;




// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog publik (tanpa login) - bisa diakses semua orang
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.public');
Route::get('/catalog/{component}', [CatalogController::class, 'show'])->name('catalog.public.show');

// Buyer routes - redirect ke katalog publik
Route::middleware(['auth', 'role:buyer'])->prefix('buyer')->name('buyer.')->group(function () {
    Route::get('/dashboard', [BuyerDashboard::class, 'index'])->name('dashboard');
    // Buyer bisa akses katalog publik, ini hanya alias untuk kemudahan
    Route::get('/catalog', function() { return redirect()->route('catalog.public'); })->name('catalog');
    Route::get('/catalog/{component}', function(\App\Models\Component $component) { 
        return redirect()->route('catalog.public.show', $component); 
    })->name('catalog.show');
});

// Seller routes
Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', [SellerDashboard::class, 'index'])->name('dashboard');
    Route::resource('components', SellerComponent::class);
    
    // Seller bisa lihat katalog untuk riset kompetitor & kompatibilitas
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/catalog/{component}', [CatalogController::class, 'show'])->name('catalog.show');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/pcbuilder', [PCBuilderController::class, 'index'])->name('pcbuilder');
    Route::post('/pcbuilder/check-compatibility', [PCBuilderController::class, 'checkCompatibility'])->name('pcbuilder.check');
    Route::post('/pcbuilder/summary', [PCBuilderController::class, 'summary'])->name('pcbuilder.summary');
});
Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/payment/{order}', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout/process/{order}', [CheckoutController::class, 'processPayment'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/add/{component}', [CartController::class, 'add'])->name('cart.add');
    Route::match(['post', 'delete'], '/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{component}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/check-compatibility', [CartController::class, 'checkCompatibility'])->name('cart.checkCompatibility');

});
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Products
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/{component}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{component}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{component}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    
    // Admin bisa akses katalog untuk lihat detail produk & kompatibilitas
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/catalog/{component}', [CatalogController::class, 'show'])->name('catalog.show');
    
    // Users
    Route::resource('users', AdminUserController::class);
    
    // Sellers
    Route::get('/sellers', [AdminSellerController::class, 'index'])->name('sellers.index');
    Route::get('/sellers/{user}', [AdminSellerController::class, 'show'])->name('sellers.show');
    
    // Orders
    Route::resource('orders', AdminOrderController::class, ['only' => ['index', 'show']]);
    Route::post('/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

require __DIR__ . '/auth.php';
