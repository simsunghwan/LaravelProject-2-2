<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  return view('welcome');
});


Route::resource('/gameBoard', \App\Http\Controllers\GameBoardController::class)->middleware(['auth', 'verified']);
Route::get('/dashboard', [\App\Http\Controllers\GameBoardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/search', [\App\Http\Controllers\GameBoardController::class, 'search'])->middleware(['auth', 'verified'])->name('search');

Route::resource('/gameBoard.comment', \App\Http\Controllers\CommentController::class)->only('store', 'update', 'destroy')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
