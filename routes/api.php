<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/quotes/{quote}/products', [QuoteItemController::class, 'show']);
Route::post('/quotes/{quote}/products', [QuoteItemController::class, 'store']);
Route::put('/quotes/{quote}/products/{product}', [QuoteItemController::class, 'update']);
Route::delete('/quotes/{quote}/products/{product}', [QuoteItemController::class, 'destroy']);
Route::apiResource('/products', ProductsController::class);
Route::apiResource('/quotes', QuoteController::class);
