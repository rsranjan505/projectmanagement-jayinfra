<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use App\Http\Controllers\Admin\Inventory\CategoryController;
use App\Http\Controllers\Admin\Inventory\ItemTransactionController;
use App\Http\Controllers\Admin\Inventory\MaterialsController;
use App\Http\Controllers\Admin\Inventory\PurchaseController;
use App\Http\Controllers\Admin\Inventory\StockController;
use App\Http\Controllers\Admin\Inventory\SupplierController;
use App\Http\Controllers\Admin\Settings\Products\UnitController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Project\Location\BlockController;
use App\Http\Controllers\Admin\Project\Location\DistrictController;
use App\Http\Controllers\Admin\Project\Location\PanchayatController;
use App\Http\Controllers\Admin\Project\Location\VillageController;
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

        Route::prefix('purchases')->group(function () {
            Route::get('/', [PurchaseController::class, 'index'])->name('purchases-list');
            Route::get('/add', [PurchaseController::class, 'create'])->name('create-purchases');
            Route::post('/add', [PurchaseController::class, 'save'])->name('save-purchases');
            Route::get('/edit/{id?}', [PurchaseController::class, 'edit'])->name('edit-purchases');
            Route::post('/edit', [PurchaseController::class, 'update'])->name('update-purchases');
            Route::get('/change-status/{id}', [PurchaseController::class, 'changeStatus'])->name('purchases-status-change');
            Route::get('/delete/{id?}', [PurchaseController::class, 'delete'])->name('purchase-delete');

            //purchase items list
            Route::get('/items-list', [ItemTransactionController::class, 'index'])->name('purchase-items-list');
            Route::get('/items-show/{purchaseId?}', [ItemTransactionController::class, 'show'])->name('purchase-items-show');
            Route::get('/items-edit/{id?}', [ItemTransactionController::class, 'edit'])->name('purchase-items-edit');
            Route::post('/items-edit', [ItemTransactionController::class, 'update'])->name('purchase-items-update');
            Route::get('/items-delete/{id?}', [ItemTransactionController::class, 'delete'])->name('purchase-items-delete');


        });

         //stock
         Route::get('/stock-list', [StockController::class, 'index'])->name('stock-list');
    });


     //Project MODULE

     Route::prefix('project')->group(function () {
        Route::prefix('location')->group(function () {
            Route::prefix('districts')->group(function () {
                Route::get('/', [DistrictController::class, 'index'])->name('districts-list');
                Route::post('/add', [DistrictController::class, 'save'])->name('save-districts');
                Route::get('/edit/{id?}', [DistrictController::class, 'edit'])->name('edit-districts');
                Route::get('/change-status/{id}', [DistrictController::class, 'changeStatus'])->name('districts-status-change');
            });

            Route::prefix('blocks')->group(function () {
                Route::get('/', [BlockController::class, 'index'])->name('blocks-list');
                Route::post('/add', [BlockController::class, 'save'])->name('save-blocks');
                Route::get('/edit/{id?}', [BlockController::class, 'edit'])->name('edit-blocks');
                Route::get('/change-status/{id}', [BlockController::class, 'changeStatus'])->name('blocks-status-change');
            });

            Route::prefix('panchayats')->group(function () {
                Route::get('/', [PanchayatController::class, 'index'])->name('panchayats-list');
                Route::post('/add', [PanchayatController::class, 'save'])->name('save-panchayats');
                Route::get('/edit/{id?}', [PanchayatController::class, 'edit'])->name('edit-panchayats');
                Route::get('/change-status/{id}', [PanchayatController::class, 'changeStatus'])->name('panchayats-status-change');
            });

            Route::prefix('villages')->group(function () {
                Route::get('/', [VillageController::class, 'index'])->name('villages-list');
                Route::post('/add', [VillageController::class, 'save'])->name('save-villages');
                Route::get('/edit/{id?}', [VillageController::class, 'edit'])->name('edit-villages');
                Route::get('/change-status/{id}', [VillageController::class, 'changeStatus'])->name('villages-status-change');
            });
        });
    });

});



