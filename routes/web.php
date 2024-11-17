<?php

use App\Http\Controllers\laravelController;
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

Route::get('/', [laravelController::class, 'index'])->name('laravel-project.index');
Route::get('/create', [laravelController::class, 'create'])->name('laravel-project.create');
Route::post('/store', [laravelController::class, 'store'])->name('laravel-project.store');
Route::get('/products/{id}', [laravelController::class, 'edit'])->name('laravel-project.edit');
Route::get('/products/{id}', [laravelController::class, 'show'])->name('laravel-project.show');
Route::put('/products/{id}', [laravelController::class, 'update'])->name('laravel-project.update');
Route::delete('/products/{id}', [laravelController::class, 'destroy'])->name('laravel-project.destroy');








