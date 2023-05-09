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
        Route::get('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/login',[LoginController::class, 'processLogin']);
    });

    // distributor authenticate
    Route::middleware('auth:distributor')->group(function(){
        Route::get('/', function() { return view('distributor.index'); });

        // the distributor routes

        Route::controller(DistributorController::class)->group(function () {
            Route::get('/distribuidor','index')->name('distributor.index');
            Route::get('/distribuidor/novo','create')->name('distributor.create');
            Route::post('/distribuidor','store')->name('distributor.store');
            Route::post('/distribuidor','show')->name('distributor.show');
            Route::get('/distribuidor/editar/{id}','edit')->name('distributor.edit');
            Route::put('/distribuidor','updated')->name('distributor.updated');
            Route::delete('/distribuidor/{id}','destroy')->name('distributor.destroy');
            Route::get('/distribuidor/visualizar/{id}','view');
        });

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

        // products
        Route::get('/produto', [ProductSisrevController::class, 'index']);
        Route::post('/produto', [ProductSisrevController::class, 'show']);
        Route::get('/produto/relatorio/', [ProductSisrevController::class, 'export']);
        Route::get('/produto/valor', [ProductValueDirectDistributorController::class, 'index']);
        Route::post('/produto/valor', [ProductValueDirectDistributorController::class, 'show']);
        Route::post('/produto/valor/unitario/adicionar', [ProductValueDirectDistributorController::class, 'store']);
        Route::post('/produto/valor/unitario/atualizar', [ProductValueDirectDistributorController::class, 'updated']);
        Route::get('/produto/valor/unitario/excluir/{id}', [ProductValueDirectDistributorController::class, 'destroy']);

        Route::post('/produto/valor/geral/', [DirectDistributorController::class, 'setGeneralValue']);

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