<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ThingController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;

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
    return view('home');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('people', PersonController::class)->middleware('auth');

Route::resource('type', TypeController::class)->middleware('auth');

Route::resource('state', StateController::class)->middleware('auth');

Route::get('/thing/bin', [ThingController::class, 'paperBin'])->name('thing.bin');
Route::put('/thing/{thing}/restore', [ThingController::class, 'restore'])->name('thing.restore');

Route::resource('thing', ThingController::class);

Route::get('/order/history', [OrderController::class, 'orderHistory'])->name('order.history');

Route::resource('order', OrderController::class);

Route::get('/order/{order}/pdf', [OrderController::class, 'exportPdf'])->name('order.pdf');









