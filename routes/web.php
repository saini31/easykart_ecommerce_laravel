<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductBookingController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\OrderController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
//=================================Base Controller==========================
Route::get('/', [BaseController::class, 'Home'])->name('home');

Route::get('/specialOffer', [BaseController::class, 'specialOffer'])->name('specialOffer');
Route::get('/delivery', [BaseController::class, 'delivery'])->name('delivery');
Route::get('/contact', [BaseController::class, 'contact'])->name('contact');
Route::get('/cart', [BaseController::class, 'cart'])->name('cart');
Route::get('/productview/{id}', [BaseController::class, 'productview'])->name('productview');
Route::get('/user_login', [BaseController::class, 'user_login'])->name('user_login');
Route::post('/user_store', [BaseController::class, 'user_store'])->name('user_store');
Route::post('/login_register', [BaseController::class, 'login_check'])->name('login_check');
Route::get('/user_logout', [BaseController::class, 'user_logout'])->name('user_logout');
//==========================Cart Handle===============================
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/delete', [CartController::class, 'destroy'])->name('cart.delete');
Route::post('/update-cart', [CartController::class, 'updateCart']);
//=======================product Booking==================================
Route::post('/product/booking', [ProductBookingController::class, 'store'])->name('product.booking');
Route::get('product//bookingCancel', [ProductBookingController::class, 'bookingFail'])->name('product.bookingFail');
Route::get('product/bokkingSuccess', [ProductBookingController::class, 'bookingSuccess'])->name('product.bookingSuccess');
//=============================Payment Handle==============================

Route::get('razorpay/form', [RazorpayPaymentController::class, 'index'])->name('razorpay');
Route::get('razorpay/payment/store', [RazorpayPaymentController::class, 'store'])->name('razorpay.store');
//==============================Products=====================
// Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/search/products', [ProductController::class, 'search'])->name('search.products');

Route::get('/products/category/{categoryId}', [BaseController::class, 'productsByCategory'])->name('products.filtered');
//====================================Order handle============

Route::post('/order/store', [OrderController::class, 'storeOrder'])->name('order.store');




Route::post('/store-product-details-session', [OrderController::class, 'storeProductDetails'])->name('store.productDetails.session');

Route::get('/user/checkout', [OrderController::class, 'checkout'])->name('user.checkout');
Route::post('/store/details', [OrderController::class, 'savePaymentDetails'])->name('save');


Route::get('/history/{id}', [OrderController::class, 'showhistory'])->name('orders.product');
Route::post('/payment/delete', [OrderController::class, 'deletePayment'])->name('payment.delete');
// Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');








// ==============Admin Route Login================================

Route::get('/adminlogin', [AdminController::class, 'login'])->name('admin.adminlogin');
Route::post('/admin/login', [AdminController::class, 'makelogin'])->name('admin.makelogin');
////============================Admin============================================================

Route::middleware(['middleware' => 'disable_btn'])->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/admin_dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/category/add', [CategoryController::class, 'create'])->name('admin.category.add');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/categories', [CategoryController::class, 'index'])->name('category.list');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('product', [ProductController::class, 'index'])->name('product.list');
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('products/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('/product/details/{id}', [ProductController::class, 'extraDetails'])->name('product.extraDetails');
        Route::post('/product/store/{id}', [ProductController::class, 'extraDetailsStore'])->name('product.extraDetailsStroe');
        Route::get('/user_data', [UserController::class, 'index'])->name('admin.user');
        Route::delete('/delete_user/{id}', [UserController::class, 'user_delete'])->name('user_delete');
        Route::get('product//bookingproducts', [ProductBookingController::class, 'index'])->name('booking.products');
        Route::delete('/prdt/delete', [ProductBookingController::class, 'destroy'])->name('prdt_delete');
        Route::get('/prdt_status', [ProductBookingController::class, 'change_productbooking_status'])->name('booking.product.status');
    });
});
