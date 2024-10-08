<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\TableOfficialController;
use App\Http\Controllers\Admin\TeamController;
use App\Models\City;
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

Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/city', [CityController::class, 'index'])->name('admin.city.index');
Route::get('/city/create', [CityController::class, 'create'])->name('admin.city.create');
Route::post('/city', [CityController::class, 'store'])->name('admin.city.store');
Route::get('/city/{city}/edit', [CityController::class, 'edit'])->name('admin.city.edit');
Route::put('/city/{city}', [CityController::class, 'update'])->name('admin.city.update');
Route::delete('/city/{city}/delete', [CityController::class, 'destroy'])->name('admin.city.destroy');

Route::get('/table-official', [TableOfficialController::class, 'index'])->name('admin.table-official.index');
Route::get('/table-official/create', [TableOfficialController::class, 'create'])->name('admin.table-official.create');
Route::post('/table-official', [TableOfficialController::class, 'store'])->name('admin.table-official.store');
Route::get('/table-official/{tableOfficial}/edit', [TableOfficialController::class, 'edit'])->name('admin.table-official.edit');
Route::put('/table-official/{tableOfficial}', [TableOfficialController::class, 'update'])->name('admin.table-official.update');
Route::delete('/table-official/{tableOfficial}/delete', [TableOfficialController::class, 'destroy'])->name('admin.table-official.destroy');

Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');
Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
Route::put('/category/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
Route::delete('/category/{category}/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

Route::get('/team', [TeamController::class, 'index'])->name('admin.team.index');
Route::get('/team/create', [TeamController::class, 'create'])->name('admin.team.create');
Route::post('/team', [TeamController::class, 'store'])->name('admin.team.store');
Route::get('/team/{team}/edit', [TeamController::class, 'edit'])->name('admin.team.edit');
Route::put('/team/{team}', [TeamController::class, 'update'])->name('admin.team.update');
Route::delete('/team/{team}/delete', [TeamController::class, 'destroy'])->name('admin.team.destroy');

Route::get('/game', [GameController::class, 'index'])->name('admin.game.index');
Route::get('/game/create', [GameController::class, 'create'])->name('admin.game.create');
Route::post('/game', [GameController::class, 'store'])->name('admin.game.store');
Route::get('/game/{game}/edit', [GameController::class, 'edit'])->name('admin.game.edit');
Route::put('/game/{game}', [GameController::class, 'update'])->name('admin.game.update');
Route::delete('/game/{game}/delete', [GameController::class, 'destroy'])->name('admin.game.destroy');