<?php

use App\Http\Controllers\ItemController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['as'=>'item.', 'prefix'=>'item'], function(){
    Route::get('', [ItemController::class, 'index'])->name('index');
    Route::get('{id}', [ItemController::class, 'show'])->name('show');
    Route::post('', [ItemController::class, 'store'])->name('store');
    Route::put('{id}', [ItemController::class, 'update'])->name('update');
    Route::delete('{id}', [ItemController::class, 'destroy'])->name('destroy');
});
