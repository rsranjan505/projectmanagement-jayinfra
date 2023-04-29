<?php

use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::prefix('user')->group(function () {
//     Route::get('/', [UsersController::class, 'index'])->name('user-list');
//     Route::get('/add', [UsersController::class, 'register'])->name('register-user');
//     Route::post('/save', [UsersController::class, 'create'])->name('register-user-save');
//     Route::get('/edit/{id?}', [UsersController::class, 'edit'])->name('edit');
//     Route::patch('/update', [UsersController::class, 'update'])->name('update');
// });
