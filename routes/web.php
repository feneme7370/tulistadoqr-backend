<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\TagController;
use App\Http\Controllers\Page\UserController;
use App\Http\Controllers\Page\GuestController;
use App\Http\Controllers\Page\LevelController;
use App\Http\Controllers\Page\ConfigController;
use App\Http\Controllers\Page\CompanyController;
use App\Http\Controllers\Page\ProductController;
use App\Http\Controllers\Page\CategoryController;
use App\Http\Controllers\Page\DashboardController;
use App\Http\Controllers\Page\MembershipController;
use App\Http\Controllers\Page\RoleController;
use App\Http\Controllers\Page\SuggestionController;
use App\Http\Controllers\Page\SocialMediaController;
use App\Livewire\Page\CategoryIndex;
use App\Livewire\Page\CompanyIndex;
use App\Livewire\Page\ConfigIndex;
use App\Livewire\Page\DashboardIndex;
use App\Livewire\Page\LevelIndex;
use App\Livewire\Page\MembershipIndex;
use App\Livewire\Page\ProductIndex;
use App\Livewire\Page\ProductPrice;
use App\Livewire\Page\RoleIndex;
use App\Livewire\Page\RolePermission;
use App\Livewire\Page\SocialMediaIndex;
use App\Livewire\Page\SuggestionIndex;
use App\Livewire\Page\TagIndex;
use App\Livewire\Page\UserIndex;

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
Route::get('/', [GuestController::class, 'index'])->name('guest.index');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',
])->group(function (){
    Route::get('/user_status', [UserController::class, 'userIsStatus'])->name('user.status');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'userIsStatus',
    // 'password.confirm',
])->group(function () {
    
    Route::get('/dashboard', DashboardIndex::class)->middleware('can:dashboard.index')->name('dashboard.index');
    Route::get('/roles', RoleIndex::class)->middleware('can:roles.index')->name('roles.index');
    Route::get('/permission', RolePermission::class)->middleware('can:roles.permission')->name('roles.permission');
    Route::get('/companies', CompanyIndex::class)->middleware('can:companies.index')->name('companies.index');
    Route::get('/memberships', MembershipIndex::class)->middleware('can:memberships.index')->name('memberships.index');
    Route::get('/tags', TagIndex::class)->middleware('can:tags.index')->name('tags.index');
    Route::get('/users', UserIndex::class)->middleware('can:users.index')->name('users.index');
    Route::get('/categories', CategoryIndex::class)->middleware('can:categories.index')->name('categories.index');
    Route::get('/levels', LevelIndex::class)->middleware('can:levels.index')->name('levels.index');
    Route::get('/products', ProductIndex::class)->middleware('can:products.index')->name('products.index');
    Route::get('/products_price', ProductPrice::class)->middleware('can:products.price')->name('products.price');
    Route::get('/suggestions', SuggestionIndex::class)->middleware('can:suggestions.index')->name('suggestions.index');
    Route::get('/social_medias', SocialMediaIndex::class)->middleware('can:social_medias.index')->name('social_medias.index');
    Route::get('/config/{company}', ConfigIndex::class)->middleware('can:config.index')->name('config.index');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('can:dashboard.index')->name('dashboard.index');
    // Route::get('/roles', [RoleController::class, 'index'])->middleware('can:roles.index')->name('roles.index');
    // Route::get('/permission', [RoleController::class, 'permission'])->middleware('can:roles.permission')->name('roles.permission');
    // Route::get('/companies', [CompanyController::class, 'index'])->middleware('can:companies.index')->name('companies.index');
    // Route::get('/memberships', [MembershipController::class, 'index'])->middleware('can:memberships.index')->name('memberships.index');
    // Route::get('/tags', [TagController::class, 'index'])->middleware('can:tags.index')->name('tags.index');
    // Route::get('/users', [UserController::class, 'index'])->middleware('can:users.index')->name('users.index');
    // Route::get('/categories', [CategoryController::class, 'index'])->middleware('can:categories.index')->name('categories.index');
    // Route::get('/levels', [LevelController::class, 'index'])->middleware('can:levels.index')->name('levels.index');
    // Route::get('/products', [ProductController::class, 'index'])->middleware('can:products.index')->name('products.index');
    // Route::get('/products_price', [ProductController::class, 'price'])->name('products.price');
    // Route::get('/suggestions', [SuggestionController::class, 'index'])->middleware('can:suggestions.index')->name('suggestions.index');
    // Route::get('/social_medias', [SocialMediaController::class, 'index'])->middleware('can:social_medias.index')->name('social_medias.index');
    // Route::get('/config/{company}', [ConfigController::class, 'index'])->middleware('can:config.index')->name('config.index');
});
