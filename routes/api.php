<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\UserHasFavorite;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserHasFavoriteController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\CourseAdvertisementController;
use App\Http\Controllers\SocialLinksController;
use App\Http\Controllers\PicturesController;
use App\Http\Controllers\AdvertisementHasPicturesController;
use App\Http\Controllers\AdvertisementHasTagsController;


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

// To show all the routes use 'php artisan route:list'

//Public routes

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


//Protected routes, authentification required
Route::group(['middleware' => ['auth:sanctum']], function () {
    //Logout
    Route::post('logout', [AuthController::class, 'logout']);

    
    Route::resource('course', CourseController::class)->only(['index', 'store', 'show']);
    
    Route::put('user/profile/{email}', [UserController::class, 'updateLoginAndName']);
    Route::put('firebase_token/{user_email}', [UserController::class, 'updateFirebaseToken']);
    Route::resource('user', UserController::class)->only(['index', 'store', 'show'])->parameters([
        'user' => 'email', // setting the email as the parameter for user
    ]);
    route::put('user/password/{email}', [UserController::class, 'updatePassword']);
    
    Route::resource('favorite', UserHasFavoriteController::class)->only(['show', 'store'])->parameters([
        'favorite' => 'user_email',
    ]);
    Route::delete('favorite', [UserHasFavoriteController::class, 'deleteFavForUser']);
    
    Route::resource('user.advertisement', AdvertisementController::class)->only(['index']);
    Route::resource('advertisement', AdvertisementController::class)->only(['store', 'update', 'destroy']);
    Route::resource('course.advertisement', CourseAdvertisementController::class)->only(['index']);
    
    Route::resource('user.social_links', SocialLinksController::class)->only(['index']);
    Route::resource('social_links', SocialLinksController::class)->only(['store', 'update'])->parameters([
        'social_links' => 'user_email'
    ]);

    Route::post('user/upload', [PicturesController::class, 'uploadProfilePicture']);

    Route::resource('advertisement/pictures', AdvertisementHasPicturesController::class)->only(['show','store']);
    Route::resource('advertisement/tags', AdvertisementHasTagsController::class)->only(['show','store', 'update', 'destroy']);
});