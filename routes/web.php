<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\inventory_controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [inventory_controller::class,'index'])->name('inventory.index');
Route::post('/borrow/{id}', [inventory_controller::class,'borrow'])->name('inventory.borrow');
Route::post('/return/{id}', [inventory_controller::class, 'returnItem'])->name('inventory.return');