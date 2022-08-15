<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
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

Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);

Route::resource('posts', PostController::class);



Route::middleware(['auth','role:ROLE_SUPERADMIN'])->group(function () {

     Route::get('/superadmin', [App\Http\Controllers\SuperAdminController::class, 'index'])->name('superadmin');
    //Category
    Route::resource('superadmin/categories', CategoryController::class);
    Route::get('/superadmin/categories/destroy/{id}', [CategoryController::class,'destroy'])->name('categories.destroy');

    //Sub Category
    Route::resource('superadmin/subcategories', SubCategoryController::class);
    Route::get('/superadmin/subcategories/destroy/{id}', [SubCategoryController::class,'destroy'])->name('subcategories.destroy');
 });

 Route::middleware(['auth','role:ROLE_USER','verified'])->group(function () {
    Route::get('/subcategory/{subcategory}',[UserSubCategoryController::class,'subcategory'])->name('subcategory.thread');
    Route::get('/subcategory/thread/{subcategory}',[UserThreadController::class,'create'])->name('thread.create');
    Route::post('/subcategory/thread/{subcategory}',[UserThreadController::class,'store'])->name('thread.store');

    Route::get('/thread/{thread}',[UserThreadController::class,'show'])->name('thread.show');
});