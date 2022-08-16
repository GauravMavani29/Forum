<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\User\SubCategoryController as UserSubCategoryController;
use App\Http\Controllers\User\ThreadController as UserThreadController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get("/logout",function(){
    Auth::logout();
    return redirect()->route("login");
})->name("logout");

Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);

Route::resource('posts', PostController::class);


//SUPERADMIN
Route::group(['middleware'=>['auth','role:ROLE_SUPERADMIN'],'prefix'=>'superadmin'],function () {

     Route::get('/', [App\Http\Controllers\SuperAdminController::class, 'index'])->name('superadmin');
    //Category
    Route::resource('categories', CategoryController::class);
    Route::get('categories/destroy/{id}', [CategoryController::class,'destroy'])->name('categories.destroy');

    //Sub Category
    Route::resource('subcategories', SubCategoryController::class);
    Route::get('subcategories/destroy/{id}', [SubCategoryController::class,'destroy'])->name('subcategories.destroy');

    //Thread
    Route::resource('threads', ThreadController::class);
    Route::get('threads/destroy/{id}', [ThreadController::class,'destroy'])->name('threads.destroy');
    Route::post('threads/block', [ThreadController::class,'block'])->name('threads.block');
 });


//USER
Route::group(['middleware'=>['auth','role:ROLE_USER,ROLE_SUPERADMIN']],function (){
    Route::get('subcategory/{subcategory}',[UserSubCategoryController::class,'subcategory'])->name('subcategory.thread');
    Route::get('subcategory/thread/{subcategory}',[UserThreadController::class,'create'])->name('thread.create');
    Route::post('subcategory/thread/{subcategory}',[UserThreadController::class,'store'])->name('thread.store');

    Route::get('thread/{thread}',[UserThreadController::class,'show'])->name('thread.show');
});