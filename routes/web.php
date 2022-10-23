<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    CategoryController,
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
});