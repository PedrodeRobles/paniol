<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ThingController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\OrderController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('people', PersonController::class)->middleware('auth');

Route::resource('type', TypeController::class)->middleware('auth');

Route::resource('state', StateController::class)->middleware('auth');

Route::resource('thing', ThingController::class);

Route::resource('order', OrderController::class);



