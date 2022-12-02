<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AccountController,
    Select2Controller,
    AuthController,
    CategoryController,
    StockController,
    ItemController,
    ItemNonAssetController,
    LoanRecordController,
    StockNonAssetController,
    DashboardController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function() {
    Route::view('/login', 'pages.Login')->name('auth.login');
    Route::post('login', [AuthController::class, 'attempt'])->name('auth.login-attempt');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', function () {
        return view('App');
    })->name('app');

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('kategori/list', [CategoryController::class, 'list'])->name('category.list');
    Route::get('kategori', [CategoryController::class, 'index'])->name('category.index');
    Route::delete('kategori/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::patch('kategori/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('kategori/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::post('kategori', [CategoryController::class, 'store'])->name('category.store');

    Route::get('stock/detail/{id}', [StockController::class, 'show'])->name('stock.show');
    Route::delete('stock/{id}', [StockController::class, 'destroy'])->name('stock.destroy');
    Route::get('stock', [StockController::class, 'index'])->name('stock.index');
    Route::get('stock-in', [StockController::class, 'indexIn'])->name('stock.index-in');
    Route::post('stock', [StockController::class, 'store'])->name('stock.store');

    Route::get('stock-out', [StockController::class, 'indexOut'])->name('stock.index-out');

    Route::get('record-in', [LoanRecordController::class, 'recordIn'])->name('record-in.index');
    Route::post('record-in', [LoanRecordController::class, 'storeRecordIn'])->name('record-in.store');

    Route::get('record-out', [LoanRecordController::class, 'recordOut'])->name('record-out.index');
    Route::post('record-out', [LoanRecordController::class, 'storeRecordOut'])->name('record-out.store');

    Route::get('item', [ItemController::class, 'index'])->name('item.index');
    Route::get('item/detail/{id}', [ItemController::class, 'show'])->name('item.show');
    Route::patch('item/detail/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('item/{id}', [ItemController::class, 'destroy'])->name('item.destroy');
    Route::post('item', [ItemController::class, 'store'])->name('item.store');
    // Export PDF
    Route::get('/exportpdf', [ItemController::class, 'exportpdf'])->name('exportpdf');




    Route::get('record-non-asset-in', [StockNonAssetController::class, 'indexIn'])->name('record-non-asset-in.index');
    Route::post('record-non-asset-in', [StockNonAssetController::class, 'store'])->name('record-in-non-asset.index');

    Route::get('record-non-asset-out', [StockNonAssetController::class, 'indexOut'])->name('record-non-asset-out.index');
    Route::post('record-non-asset-out', [StockNonAssetController::class, 'storeRecordOut'])->name('record-out-non-asset.index');

    Route::post('accounts', [AccountController::class, 'store'])->name('account.store');
    Route::get('accounts', [AccountController::class, 'index'])->name('account.index');
    Route::delete('accounts/{id}', [AccountController::class, 'destroy'])->name('account.destroy');
    Route::get('accounts/{id}', [AccountController::class, 'show'])->name('account.show');
    Route::patch('accounts/{id}', [AccountController::class, 'update'])->name('account.update');

    Route::group(['prefix' => 'select2', 'as' => 'select2.'], function() {
        Route::get('kategori', [Select2Controller::class, 'categories'])->name('categories');
        Route::get('stock', [Select2Controller::class, 'stocks'])->name('stocks');
        Route::get('items', [Select2Controller::class, 'items'])->name('items');
    });
});
