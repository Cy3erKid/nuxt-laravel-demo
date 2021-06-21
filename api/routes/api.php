<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return response()->json($request->user());
// });
Route::get('login',function() {
    return response()->json(['message' => 'Unauthorized'],401);
});
Route::post('login',LoginController::class)->name('login');


Route::group(['prefix' => 'products'],function() {
    Route::get('/',[ProductController::class,'index'])->name('api.products');
    Route::get('/export/excel',[ProductController::class,'export'])->name('api.product.export-excel');
});

Route::group(['middleware' => ['auth:sanctum']],function() {
    Route::get('/user',function (Request $request) {
        return response()->json($request->user());
    });

    

    Route::post('/logout',[LoginController::class,'logout'])->name('api.logout');

});