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
use App\Http\Controllers\CourseFilesController;
use App\Http\Controllers\SocialLinksController;
use App\Http\Controllers\AdvertisementHasPicturesController;
use App\Http\Controllers\AdvertisementHasTagsController;
use App\Http\Controllers\GlobalVariablesController;
use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\CourseHasFilesController;

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
    Route::resource('course/file', CourseHasFilesController::class)->only(['show','store','destroy']);

    Route::put('user/profile/{email}', [UserController::class, 'updateLoginAndNameAndDescription']);
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
    Route::resource('advertisement', AdvertisementController::class)->only(['store', 'update', 'destroy', 'show']);
    Route::resource('course.advertisement', CourseAdvertisementController::class)->only(['index']);
    Route::resource('course.files', CourseFilesController::class)->only(['index']);

    Route::resource('user.social_links', SocialLinksController::class)->only(['index']);
    Route::resource('globalvariables', GlobalVariablesController::class)->only(['show']);
    Route::resource('social_links', SocialLinksController::class)->only(['store', 'update'])->parameters([
        'social_links' => 'user_email'
    ]);

    Route::post('user/picture', [UserController::class, 'uploadProfilePicture']);

    Route::resource('advertisement/pictures', AdvertisementHasPicturesController::class)->only(['show','store']);
    Route::resource('advertisement/tags', AdvertisementHasTagsController::class)->only(['show','store', 'update', 'destroy']);

    Route::resource('bookmarks', BookmarksController::class)->only(['store']);
    Route::get('user/{user_email}/bookmarks', [BookmarksController::class, 'getBookmarksOfUser']);
    Route::delete('user/{user_email}/bookmarks/{advertisement_id}', [BookmarksController::class, 'deleteBookmark']);
});
