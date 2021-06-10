<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstampasController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PrecoController;
use App\Http\Middleware\VerifyIsAdmin;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Estampa;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
    $year = ['2015','2016','2017','2018','2019','2020','2021'];

        $encomendas_data = [];
        foreach ($year as $key => $value) {
            $encomendas_data[] = Encomenda::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
        }

        $user = [];
        foreach ($year as $value) {
            $user[] = User::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
            
        }
        $clientes_data = [];
        foreach ($year as $value) {
            $clientes_data[] = Cliente::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
            
        }
        $estampas_data = [];
        foreach ($year as $value) {
            $estampas_data[] = Estampa::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
            
        }

    return view('back_pages.index',compact('users', 'clientes','encomendas', 'estampas'))
    ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
    ->with('encomendas_data',json_encode($encomendas_data,JSON_NUMERIC_CHECK))
    ->with('user',json_encode($user,JSON_NUMERIC_CHECK))
    ->with('clientes_data',json_encode($clientes_data,JSON_NUMERIC_CHECK))
    ->with('estampas_data',json_encode($estampas_data,JSON_NUMERIC_CHECK));
})->name('admin');

Route::resource('admin/users', UserController::class);
Route::resource('admin/estampas', EstampasController::class);
Route::resource('admin/encomendas', EncomendaController::class);
Route::resource('admin/clientes', ClienteController::class);
Route::resource('admin/categorias', CategoriaController::class);
Route::resource('admin/cores', CorController::class);
Route::resource('admin/precos', PrecoController::class);

Route::get('/admin/client_state', [UserController::class, 'update_state'])->name('client_state');
Route::get('/admin/encomendas/state/{encomenda}{estado}', [EncomendaController::class, 'changeEncomendaEstado'])->name('encomendas.changeEncomendaEstado');

});

Route::get('/shopgrid', [App\Http\Controllers\EstampasController::class, 'index_front'])->name('shopgrid');
Route::get('/shopgrid/{id}', [App\Http\Controllers\EstampasController::class, 'show_front'])->name('shopgrid_categorias');

Route::get('/criarEstampa', [EstampasController::class, 'create'])->name('createEstampa');
Route::post('/criarEstampa', [EstampasController::class, 'store'])->name('storeEstampa');
Route::get('/minhasEstampas', [EstampasController::class, 'minhasEstampas'])->name('minhasEstampas');

Route::get('/', [MainController::class, 'index'])->name('homeT');

Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::get('/shopdetails/{id}', [MainController::class, 'shopdetails'])->name('shopdetails')->middleware('VerifyIfEstampaIsFromUser');
Route::get('/shoppingcart', [CartController::class, 'index'])->name('shoppingcart');
Route::get('/search', [MainController::class, 'search'])->name('search');

Route::middleware([VerifyIsFuncionario::class])->group(function () {

Route::get('/profile', [UserController::class, 'edit_front'])->name('profile');
Route::put('/profile/{user}', [UserController::class, 'update_front'])->name('profile_update');
});
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/remove-From-Cart/{id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::get('/edit-item-From-Cart/{id}{operator}', [CartController::class, 'editItemFromCart'])->name('editItemFromCart');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkoutcart', [CartController::class, 'checkoutCart'])->name('checkoutCart');


Route::get('verify-mail', function () {

    $user = Auth::user();
    $user->email_verified_at= Carbon::now()->toDateTimeString();
    $user->save();
    return redirect()->back();
})->name('verify_email');


Route::get('/estampas/{estampa}/imagem', [EstampasController::class, 'getEstampaPrivada'])->name('estampas.privadas');
Route::delete('/estampas/{estampa}', [EstampasController::class, 'destroy_privadas'])->name('estampas.privadas.destroy')->middleware('VerifyIfEstampaIsFromUser');
Route::get('/estampas/{estampa}/edit', [EstampasController::class, 'edit_privadas'])->name('estampas.privadas.edit')->middleware('VerifyIfEstampaIsFromUser');
Route::PATCH('/estampas/{estampa}', [EstampasController::class, 'update_privadas'])->name('estampas.privadas.update')->middleware('VerifyIfEstampaIsFromUser');


Route::get('/minhasencomendas', [EncomendaController::class, 'index_front'])->name('minhasencomendas');
Route::get('/minhasencomendas/{encomenda}', [EncomendaController::class, 'show_front'])->name('minhasencomendas.show');
Route::get('/minhasencomendas/{encomenda}/pdf', [EncomendaController::class, 'show_front_pdf'])->name('minhasencomendas.show.pdf');

