<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DirectDistributor\Auth\LoginController;

use App\Http\Controllers\DirectDistributor\Product\ProductSisrevController;
use App\Http\Controllers\DirectDistributor\Product\ProductValueController;
use App\Http\Controllers\DirectDistributor\Product\UpdateGeneralValueController;
use App\Http\Controllers\DirectDistributor\Product\UpdateProductValueSpreadsheetController;
use App\Http\Controllers\DirectDistributor\Product\UpdateUnitaryValueController;

use App\Http\Controllers\DirectDistributor\Distributor\Product\UpdateGeneralValueController as UpdateGeneralValueDistributorController;
use App\Http\Controllers\DirectDistributor\Distributor\Product\UpdateUnitaryValueController as UpdateUnitaryValueDistributorController;
use App\Http\Controllers\DirectDistributor\Distributor\Product\UpdateProductValueSpreadsheetController as UpdateProductValueSpreadsheetDistributorController;

use App\Http\Controllers\DirectDistributor\Auth\UserController as UserDirectDistributor;
use App\Http\Controllers\Distributor\UserController as UserDistributorForDirectDistributor;

use App\Http\Controllers\DirectDistributor\Distributor\DistributorController as DistributorForDirectDistributor;

use App\Http\Controllers\Quotation\QuotationItemController;
use App\Http\Controllers\Quotation\ImportForQuotationController;
use App\Http\Controllers\Quotation\QuotationController;
use App\Http\Controllers\Quotation\QuotationDatatableController;

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
    Route::middleware('guest:distributor')->group(function() {
        Route::controller(LoginController::class)->group(function() {
            Route::get('/login','index')->name('direct.distributor.login');
            Route::post('/login','store')->name('direct.distributor.login.store');
        });
    });

    // distributor authenticate
    Route::middleware('auth:distributor')->group(function(){
        Route::get('/', function() { return view('direct-distributor.index'); });

        /////////////////////// ROUTES PRODUCTS ///////////////////////
        Route::controller(ProductSisrevController::class)->group(function(){
            Route::get('/produto','index')->name('direct.distributor.product.index');
            Route::post('/produto','show')->name('direct.distributor.product.show');
            Route::get('/produto/relatorio','report')->name('direct.distributor.product.report.index');
            Route::get('/produto/relatorio/export','export')->name('direct.distributor.product.report.export');
        });

        Route::controller(ProductValueController::class)->group(function() {
            Route::get('/produto/valor','index')->name('direct.distributor.product.value.index');
            Route::post('/produto/valor','show')->name('direct.distributor.product.value.show');
        });

        Route::controller(UpdateGeneralValueController::class)->group(function() {
            Route::get('/produto/valor/geral','index')->name('direct.distributor.product.value.general.value.index');
            Route::post('/produto/valor/geral','store')->name('direct.distributor.product.value.general.value.store');
        });

        Route::controller(UpdateUnitaryValueController::class)->group(function() {
            Route::get('/produto/valor/unitario','index')->name('direct.distributor.product.value.unitary.index');
            Route::post('/produto/valor/unitario','show')->name('direct.distributor.product.value.unitary.show');
            Route::post('/produto/valor/unitario/adicionar','store')->name('direct.distributor.product.value.unitary.store');
            Route::post('/produto/valor/unitario/atualizar','updated')->name('direct.distributor.product.value.unitary.updated');
            Route::post('/produto/valor/unitario/deletar','destroy')->name('direct.distributor.product.value.unitary.destroy');
        });

        Route::controller(UpdateProductValueSpreadsheetController::class)->group(function() {
            Route::get('/produto/valor/importar','index')->name('direct.distributor.product.value.import.index');
            Route::post('/produto/valor/importar','import')->name('direct.distributor.product.value.import.import');
            Route::post('/produto/valor/importar/store','store')->name('direct.distributor.product.value.import.store');
        });

        /////////////////////// ROUTES DISTRIBUTOR FOR DIRECT DISTRIBUTOR ///////////////////////
        Route::controller(DistributorForDirectDistributor::class)->group(function() {
            Route::get('/distribuidor','index')->name('direct.distributor.distributor.index');
            Route::post('/distribuidor','show')->name('direct.distributor.distributor.show');
            Route::get('/distribuidor/novo','create')->name('direct.distributor.distributor.create');
            Route::post('/distribuidor/novo','store')->name('direct.distributor.distributor.store');
            Route::get('/distribuidor/editar/{id}','edit')->name('direct.distributor.distributor.edit');
            Route::post('/distribuidor/editar','updated')->name('direct.distributor.distributor.updated');
            Route::post('/distribuidor/destroy','destroy')->name('direct.distributor.distributor.destroy');
            Route::get('/distribuidor/visualizar/{id}','view')->name('direct.distributor.distributor.view');
        });

        Route::controller(UserDistributorForDirectDistributor::class)->group(function(){
            Route::get('/distribuidor/usuario','index')->name('direct.distributor.distributor.user.index');
            Route::get('/distribuidor/usuario/novo/{id}','create')->name('direct.distributor.distributor.user.create');
            Route::post('/distribuidor/usuario/new','store')->name('direct.distributor.distributor.user.store');
            Route::get('/distribuidor/usuario/editar/{id}','edit')->name('direct.distributor.distributor.user.edit');
            Route::post('/distribuidor/usuario/updated/','updated')->name('direct.distributor.distributor.user.updated');
            Route::get('/distribuidor/usuario/destroy/{id}','destroy')->name('direct.distributor.distributor.user.destroy');
        });

        Route::controller(UpdateGeneralValueDistributorController::class)->group(function() {
            Route::get('/distribuidor/{id}/produto/valor/geral/','index')->name('direct.distributor.distributor.product.value.general.value.index');
            Route::post('/distribuidor/produto/valor/geral','store')->name('direct.distributor.distributor.product.value.general.value.store');
        });

        Route::controller(UpdateUnitaryValueDistributorController::class)->group(function() {
            Route::get('/distribuidor/{id}/produto/valor/unitario','index')->name('direct.distributor.distributor.product.value.unitary.index');
            Route::post('/distribuidor/{id}/produto/valor/unitario','show')->name('direct.distributor.distributor.product.value.unitary.show');
            Route::post('/distribuidor/produto/valor/unitario/adicionar','store')->name('direct.distributor.distributor.product.value.unitary.store');
            Route::post('/distribuidor/produto/valor/unitario/atualizar','updated')->name('direct.distributor.distributor.product.value.unitary.updated');
            Route::post('/distribuidor/produto/valor/unitario/deletar','destroy')->name('direct.distributor.distributor.product.value.unitary.destroy');
        });

        Route::controller(UpdateProductValueSpreadsheetDistributorController::class)->group(function() {
            Route::get('distribuidor/{id}/produto/valor/importar','index')->name('direct.distributor.distributor.product.value.import.index');
            Route::post('distribuidor/produto/valor/importar','import')->name('direct.distributor.distributor.product.value.import.import');
            Route::post('distribuidor/produto/valor/importar/store','store')->name('direct.distributor.distributor.product.value.import.store');
        });

        /////////////////////// ROUTES USER DIRECT DISTRIBUTOR ///////////////////////
        Route::controller(UserDirectDistributor::class)->group(function() {
            Route::get('/usuario','index')->name('direct.distributor.user.index');
            Route::post('/usuario','show')->name('direct.distributor.user.show');
            Route::get('/usuario/new','create')->name('direct.distributor.user.create');
            Route::post('/usuario/store','store')->name('direct.distributor.user.store');
            Route::get('/usuario/edit/{id}','edit')->name('direct.distributor.user.edit');
            Route::post('/usuario/updated','updated')->name('direct.distributor.user.updated');
            Route::post('/usuario/destroy','destroy')->name('direct.distributor.user.destroy');
        });

        /////////////////////// ROUTES QUOATATION ///////////////////////
        Route::controller(QuotationController::class)->group(function() {
            Route::get('/cotacao','index')->name('direct.distributor.quotation.index');
            Route::get('/cotacao/create','create')->name('direct.distributor.quotation.create');
            Route::post('/cotacao/store','store')->name('direct.distributor.quotation.store');
            Route::post('/cotacao','show')->name('direct.distributor.quotation.show');
            Route::get('/cotacao/{id}','edit')->name('direct.distributor.quotation.edit');
            Route::post('/cotacao/updated','updated')->name('direct.distributor.quotation.updated');
            Route::post('/cotacao/destroy','destroy')->name('direct.distributor.quotation.destroy');
            Route::get('/cotacao/export/{id}', 'export')->name('direct.distributor.quotation.export.export');
        });

        Route::controller(QuotationDatatableController::class)->group(function() {
            Route::get('/cotacao/datatable/{id}','datatable')->name('direct.distributor.quotation.datatable');
        });

        Route::controller(QuotationItemController::class)->group(function() {
            Route::get('/cotacao/produto/{id}','index')->name('direct.distributor.quotation.product.index');
            Route::post('/cotacao/produto/destroy','destroy')->name('direct.distributor.quotation.product.destroy');
            Route::post('/cotacao/produto','show')->name('direct.distributor.quotation.product');
            Route::post('/cotacao/produto/add','store')->name('direct.distributor.quotation.product.add');
        });

        Route::controller(ImportForQuotationController::class)->group(function() {
            Route::post('/cotacao/product/import', 'index')->name('direct.distributor.quotation.product.import');
        });

        /////////////////////// LOGOUT ///////////////////////
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});