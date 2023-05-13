<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use App\Http\Controllers\Admin\Inventory\CategoryController;
use App\Http\Controllers\Admin\Inventory\MaterialsController;
use App\Http\Controllers\Admin\Inventory\SupplierController;
use App\Http\Controllers\Admin\Settings\Products\UnitController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Settings\CompanyProfileController;
use App\Http\Controllers\Admin\Settings\DepartmentController;
use App\Http\Controllers\Admin\Settings\DesignationController;
use App\Http\Controllers\Admin\Settings\GstController;
use App\Http\Controllers\Admin\Settings\OrganisationController;
use App\Http\Controllers\Admin\Settings\Products\BrandController;
use App\Http\Controllers\Admin\Settings\Products\TaxtRateController;
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

// Route::get('units', [UnitController::class, 'index'])->name('units-list');
// Route::get('designations', [DesignationController::class, 'index'])->name('designations-list');
// Route::get('departments', [DepartmentController::class, 'index'])->name('departments-list');
// Route::get('roles', [RolesController::class, 'index'])->name('roles-list');


Route::get('/city/{stateId}', [CityController::class, 'showByStateId'])->name('city-list');

Route::prefix('/')->middleware('auth','web')->group(function(){
    //user profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile-view');
        Route::get('/edit/{id?}', [ProfileController::class, 'edit'])->name('edit-profile');
        Route::post('/edit', [ProfileController::class, 'update'])->name('update-profile');
        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
    });
    //orgainaisation
    Route::prefix('organisation')->group(function () {
        Route::get('/', [OrganisationController::class, 'index'])->name('organisation-view');
        Route::post('/', [OrganisationController::class, 'save'])->name('save-organisation');
    });


    Route::prefix('employee')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('user-list');
        Route::get('/add', [EmployeeController::class, 'create'])->name('create-user');
        Route::post('/add', [EmployeeController::class, 'save'])->name('save-user');
        Route::get('/edit/{id?}', [EmployeeController::class, 'edit'])->name('edit-user');
        Route::post('/edit', [EmployeeController::class, 'update'])->name('update-user');
        Route::get('/change-status/{id}', [EmployeeController::class, 'changeStatus'])->name('user-status-change');
    });

    Route::prefix('company')->group(function () {
        Route::get('/profile', [CompanyProfileController::class, 'index'])->name('company-list');
        Route::get('/add', [CompanyProfileController::class, 'create'])->name('create-company');
        Route::post('/add', [CompanyProfileController::class, 'save'])->name('save-company');
        Route::get('/edit/{id?}', [CompanyProfileController::class, 'edit'])->name('edit-company');
        Route::post('/edit', [CompanyProfileController::class, 'update'])->name('update-company');
        Route::get('/change-status/{id}', [CompanyProfileController::class, 'changeStatus'])->name('company-status-change');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RolesController::class, 'index'])->name('roles-list');
        Route::get('/add', [RolesController::class, 'create'])->name('create-roles');
        Route::post('/add', [RolesController::class, 'save'])->name('save-roles');
        Route::get('/edit/{id?}', [RolesController::class, 'edit'])->name('edit-roles');
        Route::post('/edit', [RolesController::class, 'update'])->name('update-roles');
        Route::get('/change-status/{id}', [RolesController::class, 'changeStatus'])->name('roles-status-change');
    });

    Route::prefix('departments')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('departments-list');
        Route::get('/add', [DepartmentController::class, 'create'])->name('create-departments');
        Route::post('/add', [DepartmentController::class, 'save'])->name('save-departments');
        Route::get('/edit/{id?}', [DepartmentController::class, 'edit'])->name('edit-departments');
        Route::post('/edit', [DepartmentController::class, 'update'])->name('update-departments');
        Route::get('/change-status/{id}', [DepartmentController::class, 'changeStatus'])->name('departments-status-change');
    });

    Route::prefix('designations')->group(function () {
        Route::get('/', [DesignationController::class, 'index'])->name('designations-list');
        Route::get('/add', [DesignationController::class, 'create'])->name('create-designations');
        Route::post('/add', [DesignationController::class, 'save'])->name('save-designations');
        Route::get('/edit/{id?}', [DesignationController::class, 'edit'])->name('edit-designations');
        Route::get('/change-status/{id}', [DesignationController::class, 'changeStatus'])->name('designations-status-change');
    });

    Route::prefix('gsts')->group(function () {
        Route::get('/', [GstController::class, 'index'])->name('gsts-list');
        Route::get('/add', [GstController::class, 'create'])->name('create-gsts');
        Route::post('/add', [GstController::class, 'save'])->name('save-gsts');
        Route::get('/edit/{id?}', [GstController::class, 'edit'])->name('edit-gsts');
        Route::post('/edit', [GstController::class, 'update'])->name('update-gsts');
        Route::get('/change-status/{id}', [GstController::class, 'changeStatus'])->name('gsts-status-change');
    });

    ///Products Settings
    Route::prefix('settings')->group(function () {
        Route::prefix('brands')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('brands-list');
            Route::post('/add', [BrandController::class, 'save'])->name('save-brands');
            Route::get('/edit/{id?}', [BrandController::class, 'edit'])->name('edit-brands');
            Route::get('/change-status/{id}', [BrandController::class, 'changeStatus'])->name('brands-status-change');
        });

        Route::prefix('taxrates')->group(function () {
            Route::get('/', [TaxtRateController::class, 'index'])->name('taxrates-list');
            Route::post('/add', [TaxtRateController::class, 'save'])->name('save-taxrates');
            Route::get('/edit/{id?}', [TaxtRateController::class, 'edit'])->name('edit-taxrates');
            Route::get('/change-status/{id}', [TaxtRateController::class, 'changeStatus'])->name('taxrates-status-change');
        });

        Route::prefix('units')->group(function () {
            Route::get('/', [UnitController::class, 'index'])->name('units-list');
            Route::post('/add', [UnitController::class, 'save'])->name('save-units');
            Route::get('/edit/{id?}', [UnitController::class, 'edit'])->name('edit-units');
            Route::get('/change-status/{id}', [UnitController::class, 'changeStatus'])->name('units-status-change');
        });
    });




    //INVENTORY MODULE

    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category-list');
        Route::get('/add', [CategoryController::class, 'create'])->name('create-category');
        Route::post('/add', [CategoryController::class, 'save'])->name('save-category');
        Route::get('/edit/{id?}', [CategoryController::class, 'edit'])->name('edit-category');
        Route::get('/change-status/{id}', [CategoryController::class, 'changeStatus'])->name('category-status-change');
    });


    Route::prefix('inventory')->group(function () {
        Route::prefix('products')->group(function () {
            Route::get('/', [MaterialsController::class, 'index'])->name('products-list');
            Route::get('/add', [MaterialsController::class, 'create'])->name('create-products');
            Route::post('/add', [MaterialsController::class, 'save'])->name('save-products');
            Route::get('/edit/{id?}', [MaterialsController::class, 'edit'])->name('edit-products');
            Route::post('/edit', [MaterialsController::class, 'update'])->name('update-products');
            Route::get('/change-status/{id}', [MaterialsController::class, 'changeStatus'])->name('products-status-change');
        });

        Route::prefix('suppliers')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('suppliers-list');
            Route::get('/add', [SupplierController::class, 'create'])->name('create-suppliers');
            Route::post('/add', [SupplierController::class, 'save'])->name('save-suppliers');
            Route::get('/edit/{id?}', [SupplierController::class, 'edit'])->name('edit-suppliers');
            Route::post('/edit', [SupplierController::class, 'update'])->name('update-suppliers');
            Route::get('/change-status/{id}', [SupplierController::class, 'changeStatus'])->name('suppliers-status-change');
        });
    });

});



