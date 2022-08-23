<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubadminController;


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

Route::group(['prefix'=>'admin'], function($router){
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/register', [AdminController::class, 'register']);
});

Route::group(['middleware'=>['jwt.role:admin', 'jwt.auth'], 'prefix' =>'admin'], function($router){
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::get('user_profile', [AdminController::class,'userProfile']);
});

Route::group(['prefix'=>'subadmin'], function($router){
    Route::post('/login', [SubadminController::class, 'login']);
    Route::post('/register', [SubadminController::class, 'register']);

});

Route::group(['middleware' => ['jwt.role:subadmin','jwt.auth'], 'prefix'=>'subadmin'], function($router){
    Route::post('/logout', [SubadminController::class, 'logout']);
    Route::get('/user-profile',[SubadminController::class, ' userProfile']);
});