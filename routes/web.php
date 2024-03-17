<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\BoardgameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\GameAdminController;
use App\Http\Controllers\BoardgameAdminController;
use App\Http\Controllers\BoardAdminController;

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

Route::prefix('/games')->group(function() {
    Route::get('/', [GameController::class, 'index'])->name('games.index');
    Route::get('/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/', [GameController::class, 'store'])->name('games.store');
    Route::post('/storeBoard', [GameController::class, 'storeBoard'])->name('games.storeBoard');
    Route::get('/{id}', [GameController::class, 'show'])->name('games.show');
    Route::get('/{id}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/{id}/update', [GameController::class, 'update'])->name('games.update');
    Route::get('/{id}/remove/{user}', [GameController::class, 'remove'])->name('games.remove');
    Route::delete('/delete/{id}', [GameController::class, 'delete'])->name('games.delete');
    Route::post('/filter', [GameController::class, 'filter'])->name('games.filter');
    Route::get('/{id}/transfer', [GameController::class, 'transferForm'])->name('games.transferForm');
    Route::get('/{id}/transfer/{userId}', [GameController::class, 'transfer'])->name('games.transfer');
});

Route::prefix('/boardgames')->group(function() {
    Route::get('/', [BoardgameController::class, 'index'])->name('boardgames.index');
    Route::get('/add/{id}', [BoardgameController::class, 'add'])->name('boardgames.add');
    Route::get('/remove/{id}', [BoardgameController::class, 'remove'])->name('boardgames.remove');
    Route::get('/{id}/boards', [BoardgameController::class, 'boards'])->name('boardgames.boards');
    Route::get('/create', [BoardgameController::class, 'create'])->name('boardgames.create');
    Route::post('/store', [BoardgameController::class, 'store'])->name('boardgames.store');
});

Route::prefix('/boards')->group(function() {
    Route::get('/create/{id}', [BoardController::class, 'create'])->name('boards.create');
    Route::post('/store', [BoardController::class, 'store'])->name('boards.store');
});

Route::prefix('/profile')->group(function() {
    Route::get('/', [UserController::class, 'show'])->name('user.show');
    Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update', [UserController::class, 'update'])->name('user.update');
});

Route::prefix('/user')->group(function() {
    Route::get('/games', [UserController::class, 'games'])->name('user.games');
    Route::get('/boardgames', [UserController::class, 'boardgames'])->name('user.boardgames');
    Route::get('/games/add/{id}', [UserController::class, 'add'])->name('user.games.add');
    Route::get('/games/remove/{id}', [UserController::class, 'remove'])->name('user.games.remove');
});

Route::prefix('/comments')->group(function() {
    Route::delete('/delete/{id}/{game}', [CommentController::class, 'delete'])->name('comments.delete');
    Route::post('/store/{id}', [CommentController::class, 'store'])->name('comments.store');
});

Route::get('/admin', [AdminController::class, 'home'])->name('admin');

Route::prefix('/admin/users')->group(function() {
    Route::get('/', [UserAdminController::class, 'index'])->name('admin.users.index');
    Route::get('/create', [UserAdminController::class, 'create'])->name('admin.users.create');
    Route::post('/', [UserAdminController::class, 'store'])->name('admin.users.store');
    Route::get('/{id}/edit', [UserAdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/{id}', [UserAdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/{id}', [UserAdminController::class, 'delete'])->name('admin.users.delete');
});

Route::prefix('/admin/games')->group(function() {
    Route::get('/', [GameAdminController::class, 'index'])->name('admin.games.index');
    Route::get('/create', [GameAdminController::class, 'create'])->name('admin.games.create');
    Route::post('/', [GameAdminController::class, 'store'])->name('admin.games.store');
    Route::post('/{id}', [GameAdminController::class, 'storeBoard'])->name('admin.games.storeBoard');
    Route::get('/{id}/edit', [GameAdminController::class, 'edit'])->name('admin.games.edit');
    Route::put('/{id}', [GameAdminController::class, 'update'])->name('admin.games.update');
    Route::delete('/{id}', [GameAdminController::class, 'delete'])->name('admin.games.delete');
    Route::get('/{id}/transfer', [GameAdminController::class, 'transferForm'])->name('admin.games.transferForm');
    Route::get('/{id}/transfer/{userId}', [GameAdminController::class, 'transfer'])->name('admin.games.transfer');
});

Route::prefix('/admin/boardgames')->group(function() {
    Route::get('/', [BoardgameAdminController::class, 'index'])->name('admin.boardgames.index');
    Route::get('/create', [BoardgameAdminController::class, 'create'])->name('admin.boardgames.create');
    Route::post('/', [BoardgameAdminController::class, 'store'])->name('admin.boardgames.store');
    Route::get('/{id}/edit', [BoardgameAdminController::class, 'edit'])->name('admin.boardgames.edit');
    Route::put('/{id}', [BoardgameAdminController::class, 'update'])->name('admin.boardgames.update');
    Route::delete('/{id}', [BoardgameAdminController::class, 'delete'])->name('admin.boardgames.delete');
    Route::get('/{id}/validate', [BoardgameAdminController::class, 'makeValid'])->name('admin.boardgames.validate');
});

Route::prefix('/admin/boards')->group(function() {
    Route::get('/', [BoardAdminController::class, 'index'])->name('admin.boards.index');
    Route::get('/create', [BoardAdminController::class, 'create'])->name('admin.boards.create');
    Route::post('/', [BoardAdminController::class, 'store'])->name('admin.boards.store');
    Route::get('/{id}/edit', [BoardAdminController::class, 'edit'])->name('admin.boards.edit');
    Route::put('/{id}', [BoardAdminController::class, 'update'])->name('admin.boards.update');
    Route::delete('/{id}', [BoardAdminController::class, 'delete'])->name('admin.boards.delete');
    Route::get('/{id}/validate', [BoardAdminController::class, 'makeValid'])->name('admin.boards.validate');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
