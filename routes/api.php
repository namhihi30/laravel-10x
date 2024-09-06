<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'users', ['as' => 'users.'], 'middleware' => 'auth:api'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{user}', [UserController::class, 'detail'])->name('detail');
    Route::post('/', [UserController::class, 'create'])->name('create');
    Route::put('/{user}', [UserController::class, 'update'])->name('update-put');
    Route::patch('/{user}', [UserController::class, 'update'])->name('update-patch');
    Route::delete('/{user}', [UserController::class, 'delete'])->name('delete');
});

//sanctum
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('/token', [AuthController::class, 'getToken'])->middleware('auth:sanctum');
Route::post('/refresh-token', [AuthController::class, 'refreshToken']);

// JWT
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});


