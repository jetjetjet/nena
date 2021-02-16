<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarikTweetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnalyticController;

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
Route::get('/', [HomeController::class, 'index']);
Route::get('/tarik-data', [TarikTweetController::class, 'index']);

Route::get('/analytic', [AnalyticController::class, 'index']);
Route::get('/analytic/lists', [AnalyticController::class, 'getLists']);
