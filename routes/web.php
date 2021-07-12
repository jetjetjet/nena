<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarikTweetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::group(array('middleware' => 'auth'), function ()
{
  Route::get('/', [HomeController::class, 'index']);
  Route::get('/tarik-data', [TarikTweetController::class, 'index'])->middleware('role:admin');
  
  Route::get('/analytic', [AnalyticController::class, 'index']);
  Route::get('/analytic/lists', [AnalyticController::class, 'getLists']);
  
  Route::get('/export/index', [ExportController::class, 'index']);
  Route::get('/export-tweet', [ExportController::class, 'export']);

  Route::get('/user', [UserController::class, 'index']);
  Route::get('/user/grid', [UserController::class, 'grid']);
  Route::get('/user/edit/{id?}', [UserController::class, 'edit']);
  Route::post('/user', [UserController::class, 'save']);
  Route::delete('/user/{id?}', [UserController::class, 'delete']);
});