<?php

use App\Http\Controllers\dashboardcont;
use App\Http\Controllers\DatabarangController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\login_cont;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login.index');
    });
    Route::name('login.')->controller(login_cont::class)->prefix('login')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('', 'checklogin')->name('checklogin');
    });
});

Route::middleware('auth')->group(function () {
    // Route::get('/', function () {
    //     return redirect()->route('login.index');
    // });
    Route::name('dashboard.')->controller(dashboardcont::class)->prefix('dashboard')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('logout', 'logout')->name('logout');
    });
    Route::name('data.')->controller(DatabarangController::class)->prefix('data')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('create', 'create')->name('create');
        Route::post('update', 'update')->name('update');
        Route::delete('destroy', 'destroy')->name('destroy');
    });
    Route::name('kasir.')->controller(KasirController::class)->prefix('kasir')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('create', 'create')->name('create');
        Route::put('edit', 'edit')->name('edit');
        Route::post('submit', 'submitdata')->name('submitdata');
        Route::post('print', 'print')->name('print');
    });
    Route::name('report.')->controller(reportController::class)->prefix('report')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('create', 'create')->name('create');
        Route::put('edit', 'edit')->name('edit');
    });
});