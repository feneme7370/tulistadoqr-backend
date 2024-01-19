<?php

use App\Http\Controllers\Page\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\GuestController;
use App\Http\Controllers\Page\DashboardController;
use App\Http\Controllers\Page\CompanyController;
use App\Http\Controllers\Page\ConfigController;
use App\Http\Controllers\Page\LevelController;
use App\Http\Controllers\Page\MembershipController;
use App\Http\Controllers\Page\UserController;
use App\Http\Controllers\Page\ProductController;
use App\Http\Controllers\Page\SocialMediaController;
use App\Http\Controllers\Page\SuggestionController;
use App\Http\Controllers\Page\TagController;

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

Route::get('/', [GuestController::class, 'index'])->name('guest.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('can:dashboard.index')->name('dashboard.index');
    Route::get('/companies', [CompanyController::class, 'index'])->middleware('can:companies.index')->name('companies.index');
    Route::get('/memberships', [MembershipController::class, 'index'])->middleware('can:memberships.index')->name('memberships.index');
    Route::get('/users', [UserController::class, 'index'])->middleware('can:users.index')->name('users.index');
    Route::get('/categories', [CategoryController::class, 'index'])->middleware('can:categories.index')->name('categories.index');
    Route::get('/levels', [LevelController::class, 'index'])->middleware('can:levels.index')->name('levels.index');
    Route::get('/products', [ProductController::class, 'index'])->middleware('can:products.index')->name('products.index');
    Route::get('/config/{company}', [ConfigController::class, 'index'])->middleware('can:config.index')->name('config.index');
    Route::get('/suggestions', [SuggestionController::class, 'index'])->middleware('can:suggestions.index')->name('suggestions.index');
    Route::get('/tags', [TagController::class, 'index'])->middleware('can:tags.index')->name('tags.index');
    Route::get('/social_medias', [SocialMediaController::class, 'index'])->middleware('can:social_medias.index')->name('social_medias.index');
});
