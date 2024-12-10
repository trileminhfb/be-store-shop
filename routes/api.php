
<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TotalCartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Http\Request;
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

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'createData']);
Route::get('/authorization', [UserController::class, 'authorization']);

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'warehouse'], function () {
        Route::get('/', [WarehouseController::class, 'getData']);
        Route::post('/', [WarehouseController::class, 'createData']);
        Route::put('/', [WarehouseController::class, 'updateData']);
        Route::delete('/{id}', [WarehouseController::class, 'deleteData']);
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'getData']);
        Route::get('/{id}', [ProductController::class, 'getDataProduct']);
        Route::post('/', [ProductController::class, 'createData']);
        Route::put('/', [ProductController::class, 'updateData']);
        Route::delete('/{id}', [ProductController::class, 'deleteData']);
    });


    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'getData']);
        Route::post('/', [RoleController::class, 'createData']);
        Route::put('/', [RoleController::class, 'updateData']);
        Route::delete('/{id}', [RoleController::class, 'deleteData']);
    });

    // Route::get('getABC', [UserController::class, 'abc']);

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class, 'getData']);
        Route::post('/', [CartController::class, 'createData']);
        Route::put('/', [CartController::class, 'updateData']);
        Route::delete('/{id}', [CartController::class, 'deleteData']);
        Route::delete('/user/{id_user}', [CartController::class, 'deleteAllFromTable']);
    });

    Route::group(['prefix' => 'totalCart'], function () {
        Route::get('/', [TotalCartController::class, 'getData']);
        Route::post('/', [TotalCartController::class, 'createData']);
        Route::put('/', [TotalCartController::class, 'updateData']);
        Route::delete('/{id}', [TotalCartController::class, 'deleteData']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'getData']);
        Route::get('/{id}', [UserController::class, 'getDataAccout']);
        Route::put('/', [UserController::class, 'updateData']);
        Route::delete('/{id}', [UserController::class, 'deleteData']);
    });
});
