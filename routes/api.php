<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;

use App\Http\Controllers\UserController;


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

Route::get('/testing', function(){
    return ['message' => 'hello'];
});

// Route::get('user', [UserController::class, 'user']);

// To show all the routes use 'php artisan route:list'
Route::resource('user', UserController::class)->only(['index', 'show'])->parameters([
    'user' => 'email', // setting the email as the parameter for user
]);


// Route::resource([
//     'user' => UserController::class
// ]);

// Route::get('/user/{email}', function($email){
//     User::where('email', $email);
// });

Route::middleware('auth:api')->get('/auth/user', function (Request $request) {
    return $request->user();
});
