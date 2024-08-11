<?php

use App\Http\Controllers\Application\ApplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Posts\PostsController;
use App\Http\Controllers\User\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;






Route::get('/userLogin', [LoginController::class, 'index'])->name('loginPage');
Route::post('/userLogin', [LoginController::class, 'login'])->name('login');

Route::get('/register', [UserController::class, 'create'])->name('registerPage');
Route::post('/register',  [UserController::class, 'store'])->name('register');
Route::get('/blogs',  [ApplicationController::class, 'indexForAll'])->name('mainPage-nologin');

Route::group(['namespace' => 'backend', 'prefix' => '', 'middleware' => 'auth' ], function() {
    Route::get('/',  [ApplicationController::class, 'index'])->name('mainPage');
    Route::get('/addblog', [PostsController::class, 'create'])->name('addBlog');
    Route::post('/addblog', [PostsController::class, 'store'])->name('storeBlog');
    Route::get('/editBlog/{id}', [PostsController::class, 'edit'])->name('editBlog');
    Route::post('/editBlog/{id}', [PostsController::class, 'update'])->name('updateBlog');
    Route::get('/deleteBlog/{id}', [PostsController::class, 'delete'])->name('deleteBlog');

    Route::get('/blog-details/{id}', [ApplicationController::class, 'getById'])->name('blog-details');

});