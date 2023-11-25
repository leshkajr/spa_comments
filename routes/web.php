<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentsController;
use \App\Http\Controllers\CaptchaController;
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

Route::get('/', [CommentsController::class,"index"])->middleware(['web'])->name('main');
Route::post('/sendComment', [CommentsController::class,"store"])->middleware(['web'])->name('main-post');

Route::get('/refreshcaptcha', [CaptchaController::class,"getCaptcha"])->name('refreshcaptcha');

