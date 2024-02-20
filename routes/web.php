<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\BoardgameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;

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

Auth::routes();

Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
Route::post('/games/store', [GameController::class, 'store'])->name('games.store');
Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');

Route::get('/boardgames', [BoardgameController::class, 'index'])->name('boardgames.index');
Route::get('/boardgames/add/{id}', [BoardgameController::class, 'add'])->name('boardgames.add');

Route::get('/profile', [UserController::class, 'show'])->name('user.show');
Route::get('/user/games', [UserController::class, 'games'])->name('user.games');
Route::get('/user/boardgames', [UserController::class, 'boardgames'])->name('user.boardgames');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
