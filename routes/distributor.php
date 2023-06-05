<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Distributor\Auth\LoginController;

use App\Http\Controllers\Distributor\Product\ProductSisrevController;
use App\Http\Controllers\Distributor\Product\ProductValueController;
use App\Http\Controllers\Distributor\Product\UpdateGeneralValueController;
use App\Http\Controllers\Distributor\Product\UpdateProductValueSpreadsheetController;
use App\Http\Controllers\Distributor\Product\UpdateUnitaryValueController;

use App\Http\Controllers\Distributor\Distributor\Product\UpdateGeneralValueController as UpdateGeneralValueDistributorController;
use App\Http\Controllers\Distributor\Distributor\Product\UpdateUnitaryValueController as UpdateUnitaryValueDistributorController;
use App\Http\Controllers\Distributor\Distributor\Product\UpdateProductValueSpreadsheetController as UpdateProductValueSpreadsheetDistributorController;

use App\Http\Controllers\Distributor\Auth\UserController as UserDistributor;
use App\Http\Controllers\Distributor\UserController as UserDistributorForDistributor;

use App\Http\Controllers\Distributor\Distributor\DistributorController as DistributorForDistributor;

use App\Http\Controllers\Distributor\Quotation\QuotationItemController;
use App\Http\Controllers\Distributor\Quotation\ImportForQuotationController;
use App\Http\Controllers\Distributor\Quotation\QuotationController;
use App\Http\Controllers\Distributor\Quotation\QuotationDatatableController;

use Illuminate\Support\Facades\Route;

Route::prefix('parceiro')->name('distributor.')->group(function() {
    // login
    Route::middleware('guest:distributor')->group(function() {
        Route::controller(LoginController::class)->group(function() {
            Route::get('login','index')->name('distributor.login');
            Route::post('login','store')->name('distributor.login.store');
        });
    });

    // direct distributor authenticate
    Route::middleware('auth:distributor')->group(function(){
        Route::get('/', function() { return view('distributor.index'); });

        /////////////////////// ROUTES PRODUCTS ///////////////////////
        Route::controller(ProductSisrevController::class)->group(function(){
            Route::get('/produto','index')->name('product.index');
            Route::post('/produto','show')->name('product.show');
            Route::get('/produto/relatorio','report')->name('product.report.index');
            Route::get('/produto/relatorio/export','export')->name('product.report.export');
        });

        /////////////////////// ROUTES USER DIRECT DISTRIBUTOR ///////////////////////
        Route::controller(UserDistributor::class)->group(function() {
            Route::get('/usuario','index')->name('user.index');
            Route::post('/usuario','show')->name('user.show');
            Route::get('/usuario/new','create')->name('user.create');
            Route::post('/usuario/store','store')->name('user.store');
            Route::get('/usuario/edit/{id}','edit')->name('user.edit');
            Route::post('/usuario/updated','updated')->name('user.updated');
            Route::post('/usuario/destroy','destroy')->name('user.destroy');
        });

        /////////////////////// ROUTES QUOATATION ///////////////////////
        Route::controller(QuotationController::class)->group(function() {
            Route::get('/cotacao','index')->name('quotation.index');
            Route::get('/cotacao/create','create')->name('quotation.create');
            Route::post('/cotacao/store','store')->name('quotation.store');
            Route::post('/cotacao','show')->name('quotation.show');
            Route::get('/cotacao/{id}','edit')->name('quotation.edit');
            Route::post('/cotacao/updated','updated')->name('quotation.updated');
            Route::post('/cotacao/destroy','destroy')->name('quotation.destroy');
            Route::get('/cotacao/export/{id}', 'export')->name('quotation.export.export');
            Route::get('/cotacao/send/{id}','send')->name('quotation.send');
        });

        Route::controller(QuotationDatatableController::class)->group(function() {
            Route::get('/cotacao/datatable/{id}','datatable')->name('quotation.datatable');
        });

        Route::controller(QuotationItemController::class)->group(function() {
            Route::get('/cotacao/produto/{id}','index')->name('quotation.product.index');
            Route::post('/cotacao/produto/destroy','destroy')->name('quotation.product.destroy');
            Route::post('/cotacao/produto','show')->name('quotation.product');
            Route::post('/cotacao/produto/add','store')->name('quotation.product.add');
        });

        Route::controller(ImportForQuotationController::class)->group(function() {
            Route::post('/cotacao/product/import', 'index')->name('quotation.product.import');
        });

        /////////////////////// LOGOUT ///////////////////////
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});