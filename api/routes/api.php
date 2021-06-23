<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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
// Route::get('login',function() {
//     return response()->json(['message' => 'Unauthorized'],401);
// });
// laravel sanctum
//Route::post('login',LoginController::class)->name('login');
// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ], function ($router) {
//     Route::post('login',[LoginController::class,'login'])->name('login');
//     Route::post('logout', [LoginController::class,'logout'])->name('logout');
//     Route::post('refresh', [LoginController::class,'refresh'])->name('refresh');
//     Route::post('user', [LoginController::class,'user'])->name('user');
// });

// Route::group([

//     'middleware' => ['api', 'auth:api'],
//     'prefix' => 'auth'
 
//  ], function ($router) {
 
//     Route::post('login', 'AuthController@login')->withoutMiddleware(['auth:api']);
//      Route::post('logout', 'AuthController@logout');
//      Route::post('refresh', 'AuthController@refresh')->withoutMiddleware(['auth:api']);
//      Route::get('user', 'AuthController@me');
 
//  });
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login'])->name('login');
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::get('me', [AuthController::class,'me']);

});




Route::group(['prefix' => 'products'],function() {
    Route::get('/',[ProductController::class,'index'])->name('api.products');
    Route::get('/export/excel',[ProductController::class,'export'])->name('api.product.export-excel');
});

// Laravel sanctum
// Route::group(['middleware' => ['auth:sanctum']],function() {
//     Route::get('/user',function (Request $request) {
//         return response()->json($request->user());
//     });

//     Route::post('/logout',[LoginController::class,'logout'])->name('api.logout');

// });