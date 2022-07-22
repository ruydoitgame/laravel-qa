<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\QuestionsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::Resource('questions', 'App\Http\Controllers\QuestionsController');
Route::Resource('questions.answers', 'App\Http\Controllers\AnswersController');
Route::put('answers/{answer}/accept', [AnswersController::class, 'accept'])->name('answers.accept');
Route::put('questions/{question}/favorite', [QuestionsController::class, 'favorite'])->name('questions.favorite');
//Route::get('questions/{question:slug}', [QuestionsController::class, 'show'])->name('questions.show');