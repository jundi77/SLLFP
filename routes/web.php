<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function() {
    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('/polls', 'PollController@getAll');
    Route::post('/polls', 'PollController@make');
    Route::get('/polls/{id}', 'PollController@showPoll');
    Route::post('/polls/{id}', 'PollController@vote');
    Route::put('/polls/{id}', 'PollController@closeSwitch');
    Route::get('/buy/{id}', 'PaymentController@buyVote'); 
});

Route::get('/make-permission', 'PermissionTestController@index')->name('make-permission-test');
Route::get('/make-poll', 'PollingTestController@seeds');
Route::get('/test-poll', 'PollingTestController@show');
Route::get('/get-poll', 'PollController@getAll');
Route::get('/get-choice/{id}', 'PollController@getChoice');
Route::get('/get-vote-history/{id}', 'PollController@getVoteHistory');