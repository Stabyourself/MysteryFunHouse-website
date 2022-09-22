<?php

use App\Http\Controllers\DiscordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home'])->name("home");
Route::get('/info', [HomeController::class, 'info'])->name("info");
Route::get('/archive', [HomeController::class, 'archive'])->name("archive");
Route::get('/players', [HomeController::class, 'players'])->name("players");

// auth bs
Route::get('tologin', [DiscordController::class, 'tologin'])
  ->name('login');
Route::get('login', [DiscordController::class, 'loginCallback'])
  ->withoutMiddleware('VerifyCsrfToken');
Route::post('logout', [DiscordController::class, 'logout'])
  ->name('logout');


Route::get('/signup', [UserController::class, 'signupForm'])->name("signUpForm");
Route::post('/signup', [UserController::class, 'signup'])->name("signUp");
