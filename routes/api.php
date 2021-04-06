<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\UserHasFavorite;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserHasFavoriteController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\CourseAdvertisementController;
use App\Http\Controllers\SocialLinksController;


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


Route::resource('user', UserController::class)->only(['index', 'store', 'show'])->parameters([
    'user' => 'email', // setting the email as the parameter for user
]);
Route::put('user/{email}', [UserController::class, 'updateLoginAndName']);
route::put('user/password/{email}', [UserController::class, 'updatePassword']);

Route::resource('course', CourseController::class)->only(['index', 'store', 'show']);

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


// Route::get('/user/{email}', function($email){
//     User::where('email', $email);
// });

// Route::middleware('auth:api')->get('/auth/user', function (Request $request) {
//     return $request->user();
// });
