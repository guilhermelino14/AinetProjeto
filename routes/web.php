<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstampasController;
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

Route::resource('admin/users', UserController::class);
Route::resource('admin/estampas', EstampasController::class);

Route::get('/shopgrid', [App\Http\Controllers\EstampasController::class, 'index_front'])->name('shopgrid');
Route::get('/shopgrid/{id}', [App\Http\Controllers\EstampasController::class, 'show_front'])->name('shopgrid_categorias');

Route::get('/admin', function () {
    return view('back_pages.index');
})->name('admin');

Route::get('/', function () {
    return view('front_pages.index');
})->name('homeT');
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



Route::get('/shoppingcart', function () {
    return view('front_pages.shoping-cart');
})->name('shoppingcart');


// Marco
Route::get('/admin/clientes', [ClienteController::class, 'index']);


// ADMIN TEST

//Route::get('/admin/users', [UserController::class, 'index']);


Route::get('/admin/login', function () {
    return view('back_pages.login');
})->name('admin_login');

Route::get('/admin/register', function () {
    return view('back_pages.register');
})->name('admin_register');

Route::get('/admin/fpassword', function () {
    return view('back_pages.forgot-password');
})->name('admin_fpassword');
