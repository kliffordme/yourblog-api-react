<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\GetAllUsers;

use App\Models\User;


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

Route::group(['prefix' => 'users'], function ($router) {
    Route::post('/register', [UserController::class, 'register'])->name('register.user');
    Route::post('/login', [UserController::class, 'login'])->name('login.user');
    Route::get('/view-profile', [UserController::class, 'viewProfile'])->name('profile.user');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout.user');
    });

Route::group(['middleware' => 'auth:api'], function(){
    Route::apiResource('posts', PostController::class);
    Route::apiResource('likes', LikeController::class);
    Route::apiResource('comments', CommentController::class);
    Route::apiResource('followers', FollowController::class);
    Route::get('users', GetAllUsers::class);
});

Route::get('users', GetAllUsers::class);


