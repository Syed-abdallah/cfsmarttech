<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MarqueeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAddressController;
use App\Http\Controllers\PartnerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/cfadmin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('cfadmin.dashboard');





Route::group(['middleware' => ['auth'], 'prefix'=>'cfadmin', 'as'=>'cfadmin.'],function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
Route::resource('products', ProductController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class); // This already includes update route
// OR if you need separate:
Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');

Route::get('/users', [UserController::class, 'index'])->name('admin.index');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('admin.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.delete');

  
Route::resource('marquees', MarqueeController::class)->except(['show', 'create', 'edit']);
Route::post('marquees/{marquee}/toggle', [MarqueeController::class, 'toggleStatus'])
    ->name('marquees.toggle'); 
    
Route::resource('sliders', SliderController::class)->except(['show', 'create', 'edit']);
Route::post('sliders/{slider}/toggle', [SliderController::class, 'toggleStatus'])->name('sliders.toggle');

Route::resource('partners', PartnerController::class)
    ->except(['show', 'create', 'edit'])
    ->names([
        'index' => 'partners.index',
        'store' => 'partners.store',
        'update' => 'partners.update',
        'destroy' => 'partners.destroy'
    ]);


Route::post('partners/{partner}/toggle', [PartnerController::class, 'toggleStatus'])
    ->name('partners.toggle');
});


Route::get('/cfcustomer/dashboard', function () {
    return view('customer.dashboard');
})->middleware(['auth:customer'])->name('cfcustomer.dashboard');


Route::get('/add_to_cart', [FrontendController::class, 'carts']);
Route::get('/calculator', [FrontendController::class, 'calculator']);


Route::get('/message-from-management', function () {
    
    return view('frontend/ourmessage');
});

Route::middleware(['auth:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::resource('addresses', CustomerAddressController::class)->except(['show']);
    Route::post('addresses/{address}/set-default', [CustomerAddressController::class, 'setDefault'])
    ->name('addresses.set-default');

});

Route::get('/products', [FrontendController::class, 'products']);
Route::get('/product_item/{id}', [FrontendController::class, 'show'])->name('product.show');
Route::get('/product_item/{id}', [FrontendController::class, 'show'])->name('product.show');


Route::get('/', [FrontendController::class, 'index']);



require __DIR__.'/auth.php';
require __DIR__.'/customerauth.php';
