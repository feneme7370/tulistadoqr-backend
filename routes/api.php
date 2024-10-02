<?php

use App\Models\Page\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\Page\CompanyController;
use App\Http\Controllers\Api\Page\ProductController;
use App\Http\Controllers\Api\Page\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// datos de los productos de una empresa
Route::get('/products/{company}', [ProductController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// userIsStatus es si esta inhabilitado el usuario o la empresa
Route::middleware([
    'auth:sanctum',
    // config('jetstream.auth_session'),
    // 'verified',
    // 'userIsStatus',
    // 'password.confirm',
])->group(function () {

Route::post('/logout', [AuthController::class, 'logout']);
Route::apiResource('/levels', LevelController::class);
// Route::post('/levels', [LevelController::class, 'store']);
});
