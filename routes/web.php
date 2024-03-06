<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['IsLogin'])->controller(PostController::class)->group(function(){
    Route::get('posts','index')->name('posts.index');
    Route::post('post/store','store')->name('posts.store');
    Route::get('post/{id}','show')->name('posts.show');
    Route::post('delete/post/{id}','destroy')->name('posts.destroy');
    Route::get('post/edit/{id}','edit')->name('posts.edit');
    Route::post('post/update','update')->name('posts.update');
});

Route::controller(CommentController::class)->group(function(){
    Route::post('comments/store','store')->name('comments.store');
});