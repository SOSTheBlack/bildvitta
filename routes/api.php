<?php

use App\Http\Controllers\Api\Coins\ConversionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api.private')->get('/coins/conversions')->uses(ConversionController::class)->name('api.coins.conversion');
