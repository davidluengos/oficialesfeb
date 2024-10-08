<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TableOfficialController;
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