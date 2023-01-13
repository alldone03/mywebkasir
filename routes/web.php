<?php

use App\Http\Controllers\dashboardcont;
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
    Route::name('login.')->controller(login_cont::class)->prefix('login')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('', 'checklogin')->name('checklogin');
        Route::post('/logout', 'logout')->name('logout');
    });
});

Route::middleware('auth')->group(function () {
    // Route::get('/', function () {
    //     return redirect('/login');
    // });
    Route::name('dashboard.')->controller(dashboardcont::class)->prefix('dashboard')->group(function () {
        Route::get('', 'index')->name('index');
    });
});