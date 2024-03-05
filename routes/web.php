<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\BoardgameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;

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
Route::post('/games/storeBoard', [GameController::class, 'storeBoard'])->name('games.storeBoard');
Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');
Route::get('/games/{id}/edit', [GameController::class, 'edit'])->name('games.edit');
Route::put('/games/{id}/update', [GameController::class, 'update'])->name('games.update');
Route::get('/games/{id}/remove/{user}', [GameController::class, 'remove'])->name('games.remove');
Route::delete('/games/delete/{id}', [GameController::class, 'delete'])->name('games.delete');

Route::get('/boardgames', [BoardgameController::class, 'index'])->name('boardgames.index');
Route::get('/boardgames/add/{id}', [BoardgameController::class, 'add'])->name('boardgames.add');
Route::get('/boardgames/remove/{id}', [BoardgameController::class, 'remove'])->name('boardgames.remove');

Route::get('/profile', [UserController::class, 'show'])->name('user.show');
Route::get('/user/games', [UserController::class, 'games'])->name('user.games');
Route::get('/user/boardgames', [UserController::class, 'boardgames'])->name('user.boardgames');
Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');
Route::get('/user/games/add/{id}', [UserController::class, 'add'])->name('user.games.add');
Route::get('/user/games/remove/{id}', [UserController::class, 'remove'])->name('user.games.remove');

Route::delete('/comments/delete/{id}/{game}', [CommentController::class, 'delete'])->name('comments.delete');
Route::post('/comments/store/{id}', [CommentController::class, 'store'])->name('comments.store');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
