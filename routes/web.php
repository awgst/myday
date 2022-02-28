<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\TaskController;
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

// Item
Route::resource('item', ItemController::class)
    ->except('create', 'edit')
    ->parameters([
        'item' => 'id'
    ]);

// Card
Route::resource('card', CardController::class)
    ->except('create', 'edit')
    ->parameters([
        'card' => 'id'
    ]);

// Task
Route::resource('task', TaskController::class)
    ->except('create', 'edit')
    ->parameters([
        'task' => 'id'
    ]);

// JSON
Route::group(['as'=>'json.', 'prefix'=>'json/'], function(){
    Route::get('search', [JsonController::class, 'search'])->name('search');
});