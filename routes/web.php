<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
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

// Item
Route::put('item/ordering', [ItemController::class, 'ordering'])->name('item.ordering');
Route::resource('item', ItemController::class)
->except('create', 'edit')
->parameters([
    'item' => 'id'
]);

// Card
Route::put('card/ordering', [CardController::class, 'ordering'])->name('card.ordering');
Route::resource('card', CardController::class)
->except('create', 'edit')
->parameters([
    'card' => 'id'
]);

// Task
Route::put('task/ordering', [TaskController::class, 'ordering'])->name('task.ordering');
Route::resource('task', TaskController::class)
    ->except('create', 'edit')
    ->parameters([
        'task' => 'id'
    ]);

// Account
Route::resource('account', AccountController::class)->only(['index']);

// JSON
Route::group(['as'=>'json.', 'prefix'=>'json/'], function(){
    Route::get('search', [JsonController::class, 'search'])->name('search');
});

Auth::routes(['verify'=>'true']);

// OAuth Routes
Route::get('/auth/{driver}', [App\Http\Controllers\Auth\AuthController::class, 'authRedirect'])->name('auth.redirect');
Route::get('/auth/{driver}/callback', [App\Http\Controllers\Auth\AuthController::class, 'authCallback'])->name('auth.callback');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/', [App\Http\Controllers\HomeController::class, 'authenticated'])->name('authenticated')->middleware('auth');
