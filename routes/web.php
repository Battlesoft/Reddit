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
 