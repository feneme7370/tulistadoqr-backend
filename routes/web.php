<?php

use App\Livewire\Page\TagIndex;
use App\Livewire\Page\RoleIndex;
use App\Livewire\Page\UserIndex;
use App\Livewire\Page\LevelIndex;
use App\Livewire\Page\OrderIndex;
use App\Livewire\Page\ConfigIndex;
use App\Livewire\Page\CompanyIndex;
use App\Livewire\Page\ProductIndex;
use App\Livewire\Page\ProductPrice;
use App\Livewire\Page\CategoryIndex;
use App\Livewire\Page\DashboardIndex;
use App\Livewire\Page\RolePermission;
use Illuminate\Support\Facades\Route;
use App\Livewire\Page\MembershipIndex;
use App\Livewire\Page\SuggestionIndex;
use App\Livewire\Page\InformationIndex;
use App\Livewire\Page\SocialMediaIndex;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Page\UserController;
use App\Http\Controllers\Page\GuestController;
use App\Livewire\Page\ClientIndex;
use App\Livewire\Page\OrderDetail;
use App\Livewire\Page\OrderSale;
use App\Livewire\Page\StockIndex;

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
// \Debugbar::disable();
Debugbar::enable();

// vista de pagina publica
Route::get('/', [GuestController::class, 'index'])->name('guest.index');

// API de sactum
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',
])->group(function (){
    Route::get('/user_status', [UserController::class, 'userIsStatus'])->name('user.status');
});



// userIsStatus es si esta inhabilitado el usuario o la empresa
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'userIsStatus',
    // 'password.confirm',
])->group(function () {

    // vistas de livewire
    Route::get('/dashboard', DashboardIndex::class)->middleware('can:dashboard.index')->name('dashboard.index');
    Route::get('/roles', RoleIndex::class)->middleware('can:roles.index')->name('roles.index');
    Route::get('/permission', RolePermission::class)->middleware('can:roles.permission')->name('roles.permission');
    Route::get('/companies', CompanyIndex::class)->middleware('can:companies.index')->name('companies.index');
    Route::get('/memberships', MembershipIndex::class)->middleware('can:memberships.index')->name('memberships.index');
    Route::get('/tags', TagIndex::class)->middleware('can:tags.index')->name('tags.index');
    Route::get('/users', UserIndex::class)->middleware('can:users.index')->name('users.index');
    Route::get('/clients', ClientIndex::class)->middleware('can:clients.index')->name('clients.index');
    Route::get('/categories', CategoryIndex::class)->middleware('can:categories.index')->name('categories.index');
    Route::get('/levels', LevelIndex::class)->middleware('can:levels.index')->name('levels.index');
    Route::get('/stocks', StockIndex::class)->middleware('can:stocks.index')->name('stocks.index');
    Route::get('/products', ProductIndex::class)->middleware('can:products.index')->name('products.index');
    Route::get('/products_price', ProductPrice::class)->middleware('can:products.price')->name('products.price');
    Route::get('/suggestions', SuggestionIndex::class)->middleware('can:suggestions.index')->name('suggestions.index');
    Route::get('/orders', OrderIndex::class)->middleware('can:orders.index')->name('orders.index');
    Route::get('/product_orders', OrderDetail::class)->middleware('can:orders.detail')->name('orders.detail');
    Route::get('/orders_sales', OrderSale::class)->middleware('can:orders.sale')->name('orders.sale');
    Route::get('/social_medias', SocialMediaIndex::class)->middleware('can:social_medias.index')->name('social_medias.index');
    Route::get('/config/{company}', ConfigIndex::class)->middleware('can:config.index')->name('config.index');
    Route::get('/information', InformationIndex::class)->middleware('can:information.index')->name('information.index');
});
