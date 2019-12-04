<?php

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
})->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/questions', 'QuestionsController', ['except' => ['show']]);
//Route::post('/questions/{question}/answers', 'AnswersController@store')->name('answers.store');
Route::resource('questions.answers', 'AnswersController', ['only' => ['store', 'edit', 'update', 'destroy']]);
Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');
Route::post('/answers/{answer}/accept', 'AcceptAnswersController@accept')->name('answer.accept');
Route::post('/questions/{question}/favorites', 'FavortiesController@store')->name('question.favorite');
Route::delete('/questions/{question}/favorites', 'FavortiesController@destroy')->name('question.unfavorite');
Route::post('/questions/{question}/vote', 'VoteQuestionController@vote')->name('question.vote');
Route::post('/answers/{answer}/vote', 'VotAnswersController@vote')->name('answer.vote');