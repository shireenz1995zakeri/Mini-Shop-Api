<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BlogController;
use App\Http\Controllers\Api\V1\ReportProductController;
use App\Http\Controllers\Api\V1\ProductController;

use App\Http\Controllers\Api\V1\ReportBlogController;
use App\Http\Controllers\Api\V1\UserController;
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
//auth()->login(\App\Models\User::first());
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('user',\App\Http\Controllers\Api\V1\UserController::class)
    ->parameter('user','user:uuid');
//users/{user}/add/role
Route::post('user/{user}/add/role',[\App\Http\Controllers\Api\V1\UserController::class,'addRole']);
Route::delete('user/{user}/remove/{role}/role',[\App\Http\Controllers\Api\V1\UserController::class,'removeRole']);

Route::apiResource('blog',\App\Http\Controllers\Api\V1\BlogController::class)
->parameter('blog','blog:uuid');
    //->middleware('locale');

Route::apiResource('brand',\App\Http\Controllers\Api\V1\BrandController::class)
->parameter('brand','brands:uuid');
Route::get('brands/{brand}/product',[\App\Http\Controllers\Api\V1\BrandController::class,'getProducts']);
Route::apiResource('permission',\App\Http\Controllers\Api\V1\PermissionController::class);
Route::apiResource('role',\App\Http\Controllers\Api\V1\RoleController::class);


Route::apiResource('product',\App\Http\Controllers\Api\V1\BlogController::class)
    ->parameter('product','product:uuid');
Route::apiResource('category',\App\Http\Controllers\Api\V1\CategoryController::class)
->parameter('category','category:uuid');

Route::get('category/{category}/parent',[\App\Http\Controllers\Api\V1\CategoryController::class,'parent']);
Route::get('category/{category}/children',[\App\Http\Controllers\Api\V1\CategoryController::class,'children']);
Route::get('category/{category}/product',[\App\Http\Controllers\Api\V1\CategoryController::class,'getProducts']);

Route::apiResource('product',\App\Http\Controllers\Api\V1\ProductController::class);

//Route::apiResource('test',\App\Http\Controllers\TestController::class);
Route::apiResource('user',UserController::class);
//Route::get('like/{blog}/blog',\App\Http\Controllers\Api\V1\BlogController::class,'addLike');

//REPORT BLOGS
Route::get('blog/toggle/{blog}', [BlogController::class, 'toggle']);
Route::get('blog/addLike/{blog}', [BlogController::class, 'addLikeBlog']);

//TheMostVisitedBlogs
Route::get('theMostVisitedBlogs',[ ReportBlogController::class,'theMostVisitedBlogs']);
//theMostCommentBlogs
Route::get('theMostCommentBlogs',[ ReportBlogController::class,'theMostCommentBlogs']);
Route::get('reportBlog',[ ReportBlogController::class,'index']);


//REPORT PRODUCT///////////////////REPORT PRODUCT////////////////////REPORT PRODUCT////////////////////////////////////
//theMostCommentProducts
Route::get('theMostCommentProducts',[ ReportProductController::class,'theMostCommentProducts']);

//theMostVisitedProducts
Route::get('theMostVisitedProducts',[ ReportProductController::class,'theMostVisitedProducts']);

//Expensive
Route::get('expensive',[ReportProductController::class,'expensive']);

Route::get('product/toggle/{product}', [ProductController::class, 'toggle']);
Route::get('product/addLike/{product}', [ProductController::class, 'addLikeProduct']);
Route::get('reportProduct',[ReportProductController::class,'index']);

//درگاه پرداخت اینترنتی pay
Route::post('/payment/send',[\App\Http\Controllers\Api\V1\PaymentController::class,'send']);
//verify
Route::post('/payment/verify',[\App\Http\Controllers\Api\V1\PaymentController::class,'verify'])->name('payment.verify');
Route::post('login',[ AuthController::class,'loginWithCode']);
