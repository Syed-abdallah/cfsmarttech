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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ReguserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiteSettingsController;

use App\Http\Controllers\FAQController;
use App\Http\Controllers\PriceController;


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


Route::get('/history', [FrontendController::class, 'history']);
Route::get('/goal', [FrontendController::class, 'goal']);
Route::get('/offering', [FrontendController::class, 'offering']);
Route::get('/audit', [FrontendController::class, 'audit']);
Route::get('/case-study', [FrontendController::class, 'case']);
Route::get('/whyems', [FrontendController::class, 'whyems']);
Route::get('/faqs', [FrontendController::class, 'faqs']);


Route::middleware(['auth:customer'])->group(function () {
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

Route::group(['middleware' => ['auth:customer'], 'prefix'=>'cfcustomer', 'as'=>'cfcustomer.'],function(){
    
    Route::get('/orders', [OrderController::class, 'index'])->name('customer.orders.index');
    Route::get('/orders/{order_number}', [OrderController::class, 'show'])->name('customer.orders.show');
    Route::post('/orders/{order_number}/cancel', [OrderController::class, 'cancel'])->name('customer.orders.cancel');
    Route::get('/orders/{order_number}/track', [OrderController::class, 'track'])->name('customer.orders.track');
    Route::get('/orders/{order_number}/invoice', [OrderController::class, 'invoice'])->name('customer.orders.invoice');
    
});
// Route::get('/cfcustomer/dashboard', function () {
//     return view('customer.dashboard');
// })->middleware(['auth:customer'])->name('cfcustomer.dashboard');

Route::get('/cfcustomer/dashboard', [CustomerDashboardController::class, 'index'])->name('cfcustomer.dashboard')->middleware('auth:customer');

Route::middleware(['auth:customer'])->prefix('customer')->name('customer.')->group(function () {
    // Route::get('/form', [OrderController::class, 'create'])->name('customer.orders.index');
    Route::resource('addresses', CustomerAddressController::class)->except(['show']);
    Route::get('/showaddress', [CustomerAddressController::class, 'showaddress'])->name('cfcustomer.show');

    Route::post('addresses/{address}/set-default', [CustomerAddressController::class, 'setDefault'])
    ->name('addresses.set-default');

});


// Route::get('/cfadmin/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('cfadmin.dashboard');

    Route::get('/cfadmin/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('cfadmin.dashboard');

Route::group(['middleware' => ['auth:web'], 'prefix'=>'cfadmin', 'as'=>'cfadmin.'],function(){




    Route::resource('faqs', FAQController::class);






Route::resource('/commercial', \App\Http\Controllers\CommercialPriceController::class)->except(['show', 'create', 'edit']);
Route::resource('/additional-cost', \App\Http\Controllers\AdditionalCostController::class)->except(['show', 'create', 'edit']);
Route::resource('/roomtype', \App\Http\Controllers\RoomTypeController::class)->except(['show', 'create', 'edit']);





    Route::get('/userregister', [ReguserController::class, 'index'])->name('newuser.register');
    Route::post('/register', [ReguserController::class, 'registeruser'])->name('register.user');
    







    Route::post('/orders/update-status', [AdminOrderController::class, 'updateStatus'])
        ->name('orders.update-status');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');




     Route::get('/orders/{order_number}', [AdminOrderController::class, 'adminshow'])->name('admin.orders.show');
    Route::get('/orders/{order_number}/invoice', [AdminOrderController::class, 'invoice'])->name('admin.orders.invoice');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/settings', [SiteSettingsController::class, 'edit'])->name('settings.edit');
 Route::put('/site-settings', [SiteSettingsController::class, 'update'])->name('settings.update');

    
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




Route::get('/add_to_cart', [FrontendController::class, 'carts']);
Route::get('/calculator', [FrontendController::class, 'calculator']);
Route::get('/message-from-management', [FrontendController::class, 'messageFromManagement']);

Route::get('/prices', [PriceController::class, 'getAllPrices']);


Route::get('/products', [FrontendController::class, 'products']);
Route::get('/product_item/{id}', [FrontendController::class, 'show'])->name('product.show');
Route::get('/product_item/{id}', [FrontendController::class, 'show'])->name('product.show');


Route::get('/', [FrontendController::class, 'index']);



require __DIR__.'/auth.php';
require __DIR__.'/customerauth.php';
