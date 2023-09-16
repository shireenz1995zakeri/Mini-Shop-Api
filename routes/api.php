<?php

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

Route::apiResource('blog',\App\Http\Controllers\Api\V1\BlogController::class);
    //->middleware('locale');

Route::apiResource('brand',\App\Http\Controllers\Api\V1\BrandController::class);
Route::get('brands/{brand}/product',[\App\Http\Controllers\Api\V1\BrandController::class,'getProducts']);

Route::apiResource('product',\App\Http\Controllers\Api\V1\BlogController::class);
Route::apiResource('category',\App\Http\Controllers\Api\V1\CategoryController::class);

Route::get('category/{category}/parent',[\App\Http\Controllers\Api\V1\CategoryController::class,'parent']);
Route::get('category/{category}/children',[\App\Http\Controllers\Api\V1\CategoryController::class,'children']);
Route::get('category/{category}/product',[\App\Http\Controllers\Api\V1\CategoryController::class,'getProducts']);

Route::apiResource('product',\App\Http\Controllers\Api\V1\ProductController::class);

//Route::apiResource('test',\App\Http\Controllers\TestController::class);


