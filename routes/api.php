<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Posts\PostsAPIController;
use App\Http\Controllers\Posts\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/userLogin' , [LoginController::class, 'apiLogin']);
Route::post('/register', [LoginController::class, 'apiRegister']);
Route::get('/blogs', [PostsAPIController::class, 'apiGetAll'])->middleware('auth:sanctum');
Route::get('/getBlog/{id}', [PostsAPIController::class, 'apiGetById'])->middleware('auth:sanctum');
Route::post('/addBlog', [PostsAPIController::class, 'store'])->middleware('auth:sanctum');
Route::put('/editBlog/{id}', [PostsAPIController::class, 'updatee'])->middleware('auth:sanctum');
Route::delete('/deleteBlog/{id}', [PostsAPIController::class, 'delete'])->middleware('auth:sanctum');
Route::get('/logout', [LoginController::class, 'apiLogout'])->middleware('auth:sanctum');