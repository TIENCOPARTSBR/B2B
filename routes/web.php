<?php

use App\Http\Controllers\Admin\DirectDistributorController;
use App\Http\Controllers\Distributors\Auth\LoginController;
use App\Http\Controllers\Distributors\DistributorController;
use App\Http\Controllers\Distributors\ProductSisrevController;
use App\Http\Controllers\Distributors\ProductValueDirectDistributorController;
use App\Http\Controllers\Distributors\ProductValueDistributorController;
use App\Http\Controllers\Distributors\UserDistributorController;
use App\Http\Controllers\Distributors\UserDirectDistributorController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Distributors\DirectDistributorImportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas web
|--------------------------------------------------------------------------
|
| Rotas para distribuidores e empresas.
|
*/

Route::group(['middleware' => 'Language'], function() {
    // set language
    Route::get('/change-language/{lang}', [LanguageController::class, 'changeLang']);

    // login
    Route::middleware('distributor:distributor')->group(function() {
        Route::get('/login', [LoginController::class, 'index'])->name('distributor.login');
        Route::post('/login',[LoginController::class, 'store'])->name('distributor.login.store');
    });

    // distributor authenticate
    Route::middleware('auth:distributor')->group(function(){
        Route::get('/', function() { return view('distributor.index'); });

            /////////////////////
            // ROUTES PRODUCTS //
            /////////////////////
            
            Route::controller(ProductSisrevController::class)->group(function(){
                Route::get('/produto', 'index')->name('direct.distributor.product.index');
                Route::post('/produto', 'show')->name('direct.distributor.product.show');
                Route::get('/produto/relatorio','report')->name('direct.distributor.product.report.index');
                Route::get('/produto/relatorio/export','export')->name('direct.distributor.product.report.export');
            });
           

            Route::controller(ProductValueDirectDistributorController::class)->group(function(){
                Route::get('/produto/valor','index')->name('direct.distributor.product.value.index');
            });
    
            Route::post('/produto/valor', [ProductValueDirectDistributorController::class, 'show']);
            Route::post('/produto/valor/unitario/adicionar', [ProductValueDirectDistributorController::class, 'store']);
            Route::post('/produto/valor/unitario/atualizar', [ProductValueDirectDistributorController::class, 'updated']);
            Route::get('/produto/valor/unitario/excluir/{id}', [ProductValueDirectDistributorController::class, 'destroy']);
    
            Route::post('/produto/valor/geral/', [DirectDistributorController::class, 'setGeneralValue']);
    
            Route::post('/produto/valor/import', [DirectDistributorImportController::class, 'index'])->name('produto.valor.index');
            Route::post('/produto/valor/import/store', [DirectDistributorImportController::class, 'store'])->name('produto.valor.import.store');
            

        // the distributor users routes
        Route::controller(UserDistributorController::class)->group(function(){
            Route::get('/distribuidor/usuarios/novo/{id}', 'show');
            Route::post('/distribuidor/usuarios/novo', 'store');
            Route::get('/distribuidor/usuarios/editar/{id}', 'edit');
            Route::post('/distribuidor/usuarios/editar/', 'updated');
            Route::get('/distribuidor/usuarios/excluir/{id}', 'destroy');
        });

        // route, the distributors update products
        Route::get('/distribuidor/produto/valor', [ProductValueDistributorController::class, 'index']);
        Route::post('/distribuidor/produto/valor', [ProductValueDistributorController::class, 'show']);
        Route::post('/distribuidor/produto/valor/unitario/adicionar', [ProductValueDistributorController::class, 'store']);
        Route::post('/distribuidor/produto/valor/unitario/atualizar', [ProductValueDistributorController::class, 'updated']);
        Route::get('/distribuidor/produto/valor/unitario/excluir/{id}', [ProductValueDistributorController::class, 'destroy']);


        // the distributor routes
        Route::controller(DistributorController::class)->group(function() {
            Route::get('/distribuidor','index')->name('distributor.index');
            Route::get('/distribuidor/novo','create')->name('distributor.create');
            Route::post('/distribuidor/novo','store')->name('distributor.store');
            Route::post('/distribuidor','show')->name('distributor.show');
            Route::get('/distribuidor/editar/{id}','edit')->name('distributor.edit');
            Route::post('/distribuidor','updated')->name('distributor.updated');
            Route::post('/distribuidor/destroy','destroy')->name('distributor.destroy');
            Route::get('/distribuidor/visualizar/{id}','view');
        });

        // user distributor
        Route::get('/usuarios', [UserDirectDistributorController::class, 'index']);
        Route::post('/usuarios', [UserDirectDistributorController::class, 'show']);
        Route::get('/usuarios/novo', [UserDirectDistributorController::class, 'create']);
        Route::post('/usuarios/novo', [UserDirectDistributorController::class, 'store']);
        Route::get('/usuarios/editar/{id}', [UserDirectDistributorController::class, 'edit']);
        Route::post('/usuarios/editar', [UserDirectDistributorController::class, 'updated']);
        Route::get('/usuarios/excluir/{id}', [UserDirectDistributorController::class, 'destroy']);

        // logout
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});