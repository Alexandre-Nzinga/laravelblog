<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Livewire\MyPosts;


Route::get('/', function () {
    return view('welcome');
});

// 404
    Route::get('/404',[AuthController::class,'load404']);

//REGISTER
    Route::get('/registration/form',[AuthController::class,'loadRegisterForm']);

    Route::post('/register/user',[AuthController::class,'registerUser'])->name('registerUser');

//LOGIN
    Route::get('/login/form',[AuthController::class,'loadLoginForm']);

    Route::post('/login/user',[AuthController::class,'loginUser'])->name('loginUser');

    Route::get('/logout',[AuthController::class,'logoutUser']);

//USERS
    Route::get('/user/home',[UserController::class,'loadHomePage'])->middleware('user');



//POSTS
    Route::get('my/posts', [UserController::class,'loadMyPosts'])->middleware('user');

    Route::get('create/post', [UserController::class,'loadCreatePost'])->middleware('user');

    Route::get('/edit/post/{post_id}', [UserController::class,'loadEditPost'])->middleware('user');

    Route::get('/view/post/{id}',[UserController::class,'loadPostPage'])->middleware('user');

//PROFILE
    Route::get('/profile',[UserController::class,'loadProfile'])->middleware('user');

    Route::get('/view/profile/{user_id}',[UserController::class,'loadGuestProfile'])->middleware('user');

//ADMIN
    Route::get('/admin/home',[AdminController::class,'loadHomePage'])->middleware('admin');

//GUEST
    	Route::get('/welcome',[AuthController::class,'loadWelcome']);


