<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Api\GangaController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', function () {
    return UserResource::collection(User::all());
});

Route::get('/userApi/{id}', function ($id) {
    return new UserResource(User::findOrFail($id));
});
Route::post('login', [\App\Http\Controllers\Api\LoginController::class,'login']);
Route::get('/user',[usersController::class,'show'])->middleware('auth:sanctum');
//Recursos para el user
Route::get('/user/{id}', function ($id) {
    return new UserResource(User::findOrFail($id));
});

//Colecciones para el user
Route::get('/users', function () {
    return new UserCollection(User::all());
});

Route::resource('ganga', \App\Http\Controllers\Api\GangaController::class)->only(['show', 'index']);

Route::resource('ganga', \App\Http\Controllers\Api\GangaController::class)->only(['store'])->middleware(['auth:sanctum']);

Route::resource('ganga', \App\Http\Controllers\Api\GangaController::class)->only(['update', 'destroy'])->middleware(['auth:sanctum', 'CheckOwnerGanga']);


