<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubadminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;


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

//Route only for admin
Route::group(['prefix'=>'admin'], function($router){
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/register', [AdminController::class, 'register']);
});
Route::group(['middleware'=>['jwt.role:admin', 'jwt.auth'], 'prefix' =>'admin'], function($router){
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::get('/me', [AdminController::class,'userProfile']);
});


//Routes for subadmins
Route::group(['prefix'=>'subadmin'], function($router){
    Route::post('/login', [SubadminController::class, 'login']);
    Route::post('/register', [SubadminController::class, 'register']);

});
Route::group(['middleware' => ['jwt.role:subadmin','jwt.auth'], 'prefix'=>'subadmin'], function($router){
    Route::post('/logout', [SubadminController::class, 'logout']);
    Route::get('/me', [SubadminController::class, 'userProfile']);

    // Route::get('/news', [NewsController::class, 'index']); 
    // Route::get('/news/{id}', [NewsController::class, 'show']); 
    // Route::post('/news', [NewsController::class, 'store']); 
    // Route::post('/news/{id}', [NewsController::class, 'update']);
    // Route::delete('/news/{id}', [NewsController::class, 'destroy']);

});


//Routes for users
Route::group(['prefix'=>'user'], function($router){
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    //Route::post('/refresh', [UserController::class, 'refresh']);
});
Route::group(['middleware' => ['jwt.role:users', 'jwt.auth'], 'prefix' =>'user'], function($router){
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/me', [UserController::class, 'userProfile']); 
});

// Route::get('/news', [NewsController::class, 'index']); 
// Route::get('/news/{id}', [NewsController::class, 'show']); 
// Route::post('/news', [NewsController::class, 'store']); 
// Route::post('/news/{id}', [NewsController::class, 'update']);
// Route::delete('/news/{id}', [NewsController::class, 'destroy']);