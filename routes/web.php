<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ThingController;
use App\Http\Controllers\OrderController;
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

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/user/excel', [UserController::class, 'exportExcel'])->name('user.excel')->middleware('auth');
Route::post('/user/excel/import', [UserController::class, 'importExcel'])->name('users.import.excel')->middleware('auth');

Route::get('/people/excel', [PersonController::class, 'exportExcel'])->name('people.excel')->middleware('auth');
Route::post('/people/excel/import', [PersonController::class, 'importExcel'])->name('people.import.excel')->middleware('auth');
Route::resource('people', PersonController::class)->middleware('auth');

Route::get('/type/excel', [TypeController::class, 'exportExcel'])->name('type.excel')->middleware('auth');
Route::post('/type/excel/import', [TypeController::class, 'importExcel'])->name('types.import.excel')->middleware('auth');
Route::resource('type', TypeController::class)->middleware('auth');

Route::get('/thing/bin', [ThingController::class, 'paperBin'])->name('thing.bin');
Route::put('/thing/{thing}/restore', [ThingController::class, 'restore'])->name('thing.restore')->middleware('auth');
Route::get('/thing/excel', [ThingController::class, 'exportExcel'])->name('thing.excel')->middleware('auth');
Route::post('/thing/excel/import', [ThingController::class, 'importExcel'])->name('things.import.excel')->middleware('auth');
Route::resource('thing', ThingController::class);

Route::get('/order/history', [OrderController::class, 'orderHistory'])->name('order.history');
Route::get('/order/excel', [OrderController::class, 'exportExcel'])->name('orders.excel')->middleware('auth');
Route::post('/order/excel/import', [OrderController::class, 'importExcel'])->name('orders.import.excel')->middleware('auth');
Route::put('/order/action/{thing}/', [OrderController::class, 'thingOrder'])->name('order.thingOrder')->middleware('auth');
Route::resource('order', OrderController::class);
Route::get('/order/{order}/pdf', [OrderController::class, 'exportPdf'])->name('order.pdf');

Route::get('/backup', function () {
    return view('backup');
})->middleware('auth');











