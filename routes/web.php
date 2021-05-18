<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::resource('users', UserController::class);

Route::get('/', function () {
    return view('front_pages.index');
})->name('homeT');
Route::get('/blog', function () {
    return view('front_pages.blog');
})->name('blog');
Route::get('/blog-details', function () {
    return view('front_pages.blog-details');
})->name('blog-details');

Route::get('/checkout', function () {
    return view('front_pages.checkout');
})->name('checkout');
Route::get('/contact', function () {
    return view('front_pages.contact');
})->name('contact');

Route::get('/main', function () {
    return view('front_pages.main');
})->name('main');

Route::get('/shopdetails', function () {
    return view('front_pages.shop-details');
})->name('shopdetails');

Route::get('/shopgrid', function () {
    return view('front_pages.shop-grid');
})->name('shopgrid');

Route::get('/shoppingcart', function () {
    return view('front_pages.shoping-cart');
})->name('shoppingcart');