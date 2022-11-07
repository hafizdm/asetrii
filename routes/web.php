<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Select2Controller,
    AuthController,
    CategoryController,
    StockController,
    ItemController,
    LoanRecordController
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
    Route::get('record-out', [LoanRecordController::class, 'recordOut'])->name('record-out.index');

    Route::get('item', [ItemController::class, 'index'])->name('item.index');
    Route::get('item/detail/{id}', [ItemController::class, 'show'])->name('item.show');
    Route::delete('item/{id}', [ItemController::class, 'destroy'])->name('item.destroy');
    Route::post('item', [ItemController::class, 'store'])->name('item.store');

    Route::group(['prefix' => 'select2', 'as' => 'select2.'], function() {
        Route::get('kategori', [Select2Controller::class, 'categories'])->name('categories');
        Route::get('stock', [Select2Controller::class, 'stocks'])->name('stocks');
        Route::get('items', [Select2Controller::class, 'items'])->name('items');
    });

    // Route::get('mata-kuliah/detail/{id}', [CourseController::class, 'show'])->name('course.show');
    // Route::delete('mata-kuliah/{id}', [CourseController::class, 'destroy'])->name('course.destroy');
    // Route::patch('mata-kuliah/{id}', [CourseController::class, 'update'])->name('course.update');
    // Route::post('mata-kuliah', [CourseController::class, 'store'])->name('course.store');
    // Route::get('mata-kuliah', [CourseController::class, 'index'])->name('course.index');

    // Route::delete('ruang-kelas/hapus-peserta/{id}', [ClassroomController::class, 'removeParticipants'])->name('classroom.remove-participants');
    // Route::get('ruang-kelas/detail/{id}', [ClassroomController::class, 'show'])->name('classroom.show');
    // Route::delete('ruang-kelas/{id}', [ClassroomController::class, 'destroy'])->name('classroom.destroy');
    // Route::patch('ruang-kelas/{id}', [ClassroomController::class, 'update'])->name('classroom.update');
    // Route::post('ruang-kelas', [ClassroomController::class, 'store'])->name('classroom.store');
    // Route::get('ruang-kelas', [ClassroomController::class, 'index'])->name('classroom.index');

    // php artisan make:controller LoanRecordController
});