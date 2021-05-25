<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstampasController;
use App\Http\Controllers\MainController;
use App\Models\Encomenda;
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


Route::get('/admin', function () {
    return view('back_pages.index');
})->name('admin');

Route::resource('admin/users', UserController::class);
Route::resource('admin/estampas', EstampasController::class);
Route::resource('admin/encomendas', EncomendaController::class);
Route::resource('admin/clientes', ClienteController::class);


Route::get('/shopgrid', [App\Http\Controllers\EstampasController::class, 'index_front'])->name('shopgrid');
Route::get('/shopgrid/{id}', [App\Http\Controllers\EstampasController::class, 'show_front'])->name('shopgrid_categorias');

Route::get('/', [MainController::class, 'index'])->name('homeT');
Route::get('/checkout', [MainController::class, 'checkout'])->name('checkout');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::get('/shopdetails/{id}', [MainController::class, 'shopdetails'])->name('shopdetails');
Route::get('/shoppingcart', [MainController::class, 'shoppingcart'])->name('shoppingcart');
Route::get('/search', [MainController::class, 'search'])->name('search');


Route::get('/profile', [UserController::class, 'edit_front'])->name('profile');
Route::put('/profile/{user}', [UserController::class, 'update_front'])->name('profile_update');
