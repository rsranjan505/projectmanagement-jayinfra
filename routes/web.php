<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use App\Http\Controllers\Admin\Inventory\UnitController;
use App\Http\Controllers\Admin\Settings\DepartmentController;
use App\Http\Controllers\Admin\Settings\DesignationController;
use App\Http\Controllers\Admin\Settings\RolesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', [HomeController::class, 'index'])->name('home');



//Admin Section
Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('units', [UnitController::class, 'index'])->name('units-list');
Route::get('designations', [DesignationController::class, 'index'])->name('designations-list');
Route::get('departments', [DepartmentController::class, 'index'])->name('departments-list');
Route::get('roles', [RolesController::class, 'index'])->name('roles-list');


Route::get('/city/{stateId}', [CityController::class, 'showByStateId'])->name('city-list');

Route::prefix('employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('user-list');
    Route::get('/add', [EmployeeController::class, 'create'])->name('create-user');
    Route::post('/add', [EmployeeController::class, 'save'])->name('save-user');
    Route::get('/edit/{id?}', [EmployeeController::class, 'edit'])->name('edit-user');
    Route::patch('/edit', [EmployeeController::class, 'update'])->name('update-user');
});


