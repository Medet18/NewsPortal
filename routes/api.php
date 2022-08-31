<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubadminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SunadminUserController;


//Route only for admin
Route::group(['prefix'=>'admin'], function($router){
    Route::post('/login',    [AdminController::class, 'login']);
    Route::post('/register', [AdminController::class, 'register']);
});
Route::group(['middleware'=>['jwt.role:admin', 'jwt.auth'], 'prefix' =>'admin'], function($router){
    Route::post('/', [AdminController::class, 'logout'])->name('logout');
    Route::get('/',  [AdminController::class,'userProfile'])->name('me');

    //edit subadmins
    Route::group(['prefix'=>'edit/subadmins'], function($router){
        Route::get('/',     [SunadminUserController::class, 'index_subadmins'])->name('index_subadmins');
        Route::get('/{id}', [SunadminUserController::class, 'show_subadmin'])->name('show_subadmin');
        Route::delete('/{id}',  [SunadminUserController::class, 'destroy_subadmin'])->name('destroy_subadmin');
    });

    //edit users
    Route::group(['prefix'=>'edit/users'], function($router){
        Route::get('/',     [SunadminUserController::class, 'index_users'])->name('index_users');
        Route::get('/{id}', [SunadminUserController::class, 'show_user'])->name('show_user');
        Route::delete('/{id}',  [SunadminUserController::class, 'destroy_user'])->name('destroy_user');
    });
});





//Routes for subadmins
Route::group(['prefix'=>'subadmin'], function($router){
    Route::post('/login',    [SubadminController::class, 'login']);
    Route::post('/register', [SubadminController::class, 'register']);

});
Route::group(['middleware' => ['jwt.role:subadmin','jwt.auth'], 'prefix'=>'subadmin'], function($router){
    Route::post('/', [SubadminController::class, 'logout'])->name('logout');
    Route::get('/',  [SubadminController::class, 'userProfile'])->name('me');
    
    Route::group(['prefix'=>'edit/news'], function($router){
        Route::get('/',     [NewsController::class, 'index_subadmin'])->name('index_subadmin'); 
        Route::get('/{id}', [NewsController::class, 'show_subadmin'])->name('show_subadmin'); 
        Route::post('/',    [NewsController::class, 'store'])->name('store'); 
        Route::put('/{id}', [NewsController::class, 'update'])->name('update');
        Route::delete('/{id}', [NewsController::class, 'destroy'])->name('destroy');
    });
});





//Routes for users
Route::group(['prefix'=>'user'], function($router){
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login',    [UserController::class, 'login']);
});
Route::group(['middleware' => ['jwt.role:users', 'jwt.auth'], 'prefix' =>'user'], function($router){
    Route::post('/', [UserController::class, 'logout'])->name('logout');
    Route::get('/',  [UserController::class, 'userProfile'])->name('me'); 
    
    Route::group(['prefix'=>'show/news'], function($router){
        Route::get('/',     [NewsController::class, 'index_user'])->name('index_user'); 
        Route::get('/{id}', [NewsController::class, 'show_user'])->name('show_user');
    });
});



// $post->title = 'new title';
// $post->tag = 'new tag';


// if (!$post->is($post->fresh()) {
//    $post->update();
// }

//$products = Product::where('user_id',2)->latest()->paginate(20);
//its work by ```` $products = Product::where('user_id',auth()->user()->id)->latest()->paginate(20);
//Try Product::where('user_id', auth()->id()).



