<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\ApiAuthMiddleware;
use App\Http\Controllers\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/users', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);

Route::middleware(ApiAuthMiddleware::class)->group(function (){
    Route::get('/users/current', [UserController::class, 'get']);
    Route::delete('/users/logout', [UserController::class, 'logout']);

    Route::post('/vendor', [VendorController::class, 'register']);
    Route::post('/vendor/{idVendor}/products', [ProductController::class, 'create'])
        ->where('idVendor', '[0-9]+');
    Route::get('/vendor/{idVendor}/products/{idProduct}', [ProductController::class, 'get'])
        ->where('idVendor', '[0-9]+')
        ->where('idProduct', '[0-9]+');
    Route::put('/vendor/{idVendor}/products/{idProduct}', [ProductController::class, 'update'])
        ->where('idVendor', '[0-9]+')
        ->where('idProduct', '[0-9]+');
    Route::delete('/vendor/{idVendor}/products/{idProduct}', [ProductController::class, 'delete'])
        ->where('idVendor', '[0-9]+')
        ->where('idProduct', '[0-9]+');
});