<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\AboutController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/verification/notice');

Route::get('/trade', [TradeController::class, 'index']);

Route::get('/assets/tradetable', [TradeController::class, 'tradeTable']);
Route::post('/assets/tradetable/{id}', [TradeController::class, 'selectMaterial']);
Route::get('/assets/graph/{id}', [TradeController::class, 'getGraph']);

//->middleware('throttle:5,1')