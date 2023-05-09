<?php 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\DirectDistributorController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SystemConfigurationController;

Route::name('admin.')->prefix('admin')->group(function(){
    Route::group(['middleware' => 'Language'], function() {
        // set locale
        Route::get('/change-language/{lang}', [LanguageController::class, 'changeLang']);

        Route::namespace('Auth')->middleware('distributor:admin')->group(function(){
            //login route
            Route::get('/login', [LoginController::class, 'login'])->name('login');
            Route::post('/login',[LoginController::class, 'processLogin']);
        });

        Route::namespace('Auth')->middleware('auth:admin')->group(function(){
            Route::get('/', [ProductsController::class, 'index']);

            // admin
            Route::get('/usuarios', [UserAdminController::class, 'index']);
            Route::post('/usuarios', [UserAdminController::class, 'show']);
            Route::get('/usuarios/novo', [UserAdminController::class, 'create']);
            Route::post('/usuarios/novo', [UserAdminController::class, 'store']);
            Route::get('/usuarios/editar/{id}', [UserAdminController::class, 'edit']);
            Route::post('/usuarios/editar', [UserAdminController::class, 'updated']);
            Route::get('/usuarios/excluir/{id}', [UserAdminController::class, 'destroy']);

            // products
            Route::get('/produtos', [ProductsController::class, 'index']);
            Route::post('/produtos', [ProductsController::class, 'search']);

            // group company
            Route::get('/distribuidor', [DirectDistributorController::class, 'index']);
            Route::post('/distribuidor', [DirectDistributorController::class, 'show']);
            Route::get('/distribuidor/novo', [DirectDistributorController::class, 'create']);
            Route::post('/distribuidor/novo', [DirectDistributorController::class, 'store']);
            Route::get('/distribuidor/editar/{id}', [DirectDistributorController::class, 'edit']);
            Route::post('/distribuidor/editar', [DirectDistributorController::class, 'updated']);
            Route::get('/distribuidor/excluir/{id}', [DirectDistributorController::class, 'destroy']);

            // system configuration
            Route::get('/config', [SystemConfigurationController::class, 'index']);
            Route::post('/config', [SystemConfigurationController::class, 'updated']);

            Route::post('/logout',function(){
                Auth::guard('admin')->logout();
                return redirect()->action([
                    LoginController::class,
                    'login'
                ]);
            })->name('logout');
        });
    });
});