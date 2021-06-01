<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstampasController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\VerifyIsAdmin;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Estampa;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

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

Route::middleware([VerifyIsAdmin::class])->group(function () {
Route::get('/admin', function () {
    $users = User::count();
    $clientes = Cliente::count();
    $encomendas = Encomenda::count();
    $estampas = Estampa::count();
    return view('back_pages.index',compact('users', 'clientes','encomendas', 'estampas'));
})->name('admin');

Route::resource('admin/users', UserController::class);
Route::resource('admin/estampas', EstampasController::class);
Route::resource('admin/encomendas', EncomendaController::class);
Route::resource('admin/clientes', ClienteController::class);

});

Route::get('/shopgrid', [App\Http\Controllers\EstampasController::class, 'index_front'])->name('shopgrid');
Route::get('/shopgrid/{id}', [App\Http\Controllers\EstampasController::class, 'show_front'])->name('shopgrid_categorias');

Route::get('/criarEstampa', [EstampasController::class, 'create'])->name('createEstampa');
Route::post('/criarEstampa', [EstampasController::class, 'store'])->name('storeEstampa');
Route::get('/minhasEstampas', [EstampasController::class, 'minhasEstampas'])->name('minhasEstampas');

Route::get('/', [MainController::class, 'index'])->name('homeT');

Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::get('/shopdetails/{id}', [MainController::class, 'shopdetails'])->name('shopdetails');
Route::get('/shoppingcart', [CartController::class, 'index'])->name('shoppingcart');
Route::get('/search', [MainController::class, 'search'])->name('search');


Route::get('/profile', [UserController::class, 'edit_front'])->name('profile');
Route::put('/profile/{user}', [UserController::class, 'update_front'])->name('profile_update');


Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/remove-From-Cart/{id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::get('/edit-item-From-Cart/{id}{operator}', [CartController::class, 'editItemFromCart'])->name('editItemFromCart');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::get('verify-mail', function () {
   
    $user = Auth::user();
    $user->email_verified_at= Carbon::now()->toDateTimeString();
    $user->save();
    return redirect()->back();
})->name('verify_email');