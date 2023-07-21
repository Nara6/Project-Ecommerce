<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BillingAddressController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\ShippingMethodController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ImageController;


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

Route::prefix('auth')->group(function(){
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('register', [AuthController::class, 'register']);

});
Route::middleware('jwt.verify')->group(function(){
    Route::get('me',[AuthController::class,'get_user']);
    Route::post('logout', [AuthController::class,'logout']);
});

Route::get('category/read', [CategoryController::class, 'read']);
Route::get('item/read', [ItemController::class, 'read']);
Route::get('color/read', [ColorController::class, 'read']);
Route::get('product/read', [ProductController::class, 'read']);
// Route::get('product/read/{category_id?}/{item_id?}', [ProductController::class, 'read']);
Route::get('product/read/{id}', [ProductController::class, 'getProductById']);
Route::get('billingaddress/read', [BillingAddressController::class, 'read']);
Route::get('shippingaddress/read', [ShippingAddressController::class, 'read']);
Route::get('shippingmethod/read', [ShippingMethodController::class, 'read']);
Route::get('paymentmethod/read', [PaymentMethodController::class, 'read']);
Route::get('order/read', [OrderController::class, 'read']);
Route::get('orderdetail/read', [OrderDetailController::class, 'read']);


Route::middleware('jwt.verify')->prefix('category')->group(function(){
    Route::post('create', [CategoryController::class, 'create']);
});
Route::middleware('jwt.verify')->prefix('item')->group(function(){
    Route::post('create', [ItemController::class, 'create']);
});
Route::middleware('jwt.verify')->prefix('color')->group(function(){
    Route::post('create', [ColorController::class, 'create']);
});
Route::middleware('jwt.verify')->prefix('product')->group(function(){
    Route::post('create', [ProductController::class, 'create']);
});
Route::middleware('jwt.verify')->prefix('billingaddress')->group(function(){
    Route::post('create', [BillingAddressController::class, 'create']);
});
Route::middleware('jwt.verify')->prefix('shippingaddress')->group(function(){
    Route::post('create', [ShippingAddressController::class, 'create']);
}); 
Route::middleware('jwt.verify')->prefix('shippingmethod')->group(function(){
    Route::post('create', [ShippingMethodController::class, 'create']);
});
Route::middleware('jwt.verify')->prefix('paymentmethod')->group(function(){
    Route::post('create', [PaymentMethodController::class, 'create']);
});
Route::middleware('jwt.verify')->prefix('order')->group(function(){
    Route::post('create', [OrderController::class, 'create']);
});
Route::middleware('jwt.verify')->prefix('orderdetail')->group(function(){
    Route::post('create', [OrderDetailController::class, 'create']);
});
Route::middleware('jwt.verify')->prefix('image')->group(function(){
    Route::post('create', [ImageController::class, 'create']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
