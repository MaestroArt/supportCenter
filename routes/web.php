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
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', function () {
    return redirect('/feedbacks');
})->middleware('auth');

Route::get('/feedback', 'FeedbackController@showForm')->middleware('auth');
Route::get('/feedbacks', 'FeedbackController@showAll')->middleware('auth');

Route::post('/feedback', 'FeedbackController@saveFeedback')->middleware('auth');

Route::get('/dialog/{feedback_id}',[
   'uses'=>'FeedbackController@dialog',
    'as'=>'dialog'
])->middleware('auth');
Route::post('/dialog', 'FeedbackController@saveDialog')->middleware('auth');
