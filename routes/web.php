<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GangaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ganga', \App\Http\Controllers\GangaController::class)->except(['show']);
Route::get('ganga/news', [GangaController::class, 'news'])->name('ganga.news');
Route::get('ganga/highlights', [GangaController::class, 'highlights'])->name('ganga.highlights');
Route::get('ganga', [GangaController::class, 'index']);
Route::get('ganga/show/{id}', [GangaController::class, 'show']);

Route::post('/thumbUp/{id}', [GangaController::class, 'thumbUp'])->name('ganga.thumbUp');
Route::post('/thumbDown/{id}', [GangaController::class, 'thumbDown'])->name('ganga.thumbDown');

Route::middleware('auth')->group(function () {

});

Route::resource('user', \App\Http\Controllers\UsersController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
