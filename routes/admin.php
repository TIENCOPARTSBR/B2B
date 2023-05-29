<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Config\ConfigController;
use App\Http\Controllers\Admin\User\UserAdminController;
use App\Http\Controllers\Admin\DirectDistributorController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\Product\ProductController;

// Admin
Route::name('admin.')->prefix('admin')->group(function(){
    Route::group(['middleware' => 'Language'], function() {
        // Language
        Route::get('/change-language/{lang}', [LanguageController::class, 'changeLang']);

        Route::middleware('guest:admin')->group(function(){
            // Login
            Route::controller(LoginController::class)->group(function() {
                Route::get('/login','login')->name('login');
                Route::post('/login','processLogin')->name('login.store');
            });
        });

        Route::middleware('auth:admin')->group(function(){
            // User
            Route::controller(UserAdminController::class)->group(function() {
                Route::get('/usuario', 'index')->name('user.index');
                Route::post('/usuario', 'show')->name('user.show');
                Route::get('/usuario/new', 'create')->name('user.create');
                Route::post('/usuario/store', 'store')->name('user.store');
                Route::get('/usuario/edit/{id}', 'edit')->name('user.edit');
                Route::post('/usuario/updated', 'updated')->name('user.updated');
                Route::post('/usuario/destroy', 'destroy')->name('user.destroy');
            });

            // Products
            Route::controller(ProductController::class)->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/produto', 'index')->name('product.index');
                Route::post('/produto', 'show')->name('product.show');
            });

            // Direct Distributor
            Route::controller(DirectDistributorController::class)->group(function() {
                Route::get('/distribuidor-direto', 'index')->name('direct.distributor.index');
                Route::post('/distribuidor-direto', 'show')->name('direct.distributor.show');
                Route::get('/distribuidor-direto/create', 'create')->name('direct.distributor.create');
                Route::post('/distribuidor-direto/store', 'store')->name('direct.distributor.store');
                Route::get('/distribuidor-direto/edit/{id}', 'edit')->name('direct.distributor.edit');
                Route::post('/distribuidor-direto/updated', 'updated')->name('direct.distributor.updated');
                Route::post('/distribuidor-direto/destroy', 'destroy')->name('direct.distributor.destroy');
            });

            // System configuration
            Route::controller(ConfigController::class)->group(function() {
                Route::get('/config','index')->name('config.index'); 
                Route::post('/config','updated')->name('config.updated');
            });

            Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        });
    });
});