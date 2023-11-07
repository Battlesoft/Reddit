<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => 'true']);

Route::get('/home', function () {
    return view('home');
 })->middleware(['auth', 'verified'])->name('home');

 Route::middleware(['auth'])->group(function () {
    
});



 Route::get('community', [App\Http\Controllers\CommunityLinkController::class, 'index']);
 Route::post('community', [App\Http\Controllers\CommunityLinkController::class, 'store'])->middleware(['auth', 'verified']);



 Route::post('votes/{link}', [App\Http\Controllers\CommunityLinkUserController::class, 'store'])->middleware(['auth', 'verified']);

 Route::get('community/{channel:slug}', [App\Http\Controllers\CommunityLinkController::class, 'index']);
 
 Route::get('/community-links', 'CommunityLinkController@index');
 
 // Rutas para el perfil de usuario
 Route::resource('profile', 'ProfileController');

// Ruta para la edición de perfil
Route::post('/profile/store', [App\Http\Controllers\ProfileController::class, 'store'])->middleware(['auth'])->name('profile.edit');
Route::get('/profile', [App\Http\Controllers\ProfileController::class,'index'])->middleware(['auth'])->name('profile');


Route::resource('users', 'App\Http\Controllers\UserController')->middleware(['auth', 'verified']);