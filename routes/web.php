<?php

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

Route::namespace('Main')->group(function() {
    Route::name('signup.')
        ->controller('SignupController')
        ->middleware('guest')
        ->group(function() {
            Route::get('/signup', 'index')->name('index');
            Route::post('/signup', 'signup')->name('process');
        });
    
    Route::name('dashboard')
        ->controller('DashboardController')
        ->middleware(['auth', 'CheckActiveMahasiswa'])
        ->group(function() {
            Route::get('/', 'index');
            Route::get('/dashboard/chart/{kategori}/{jumlah}', 'chart')->name('.chart');
            Route::get('/dashboard/divisi/{uuid}/', 'divisi')->name('.divisi');
        });
});

Route::namespace('Main')->middleware(['auth','isAdmin'])->group(function() {
    Route::controller('PendaftaranController')
        ->prefix('/pendaftaran')
        ->name('pendaftaran.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/edit/{uuid}', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
    });

    Route::controller('DivisiController')
        ->prefix('/divisi')
        ->name('divisi.')
        ->group(function() {
            Route::get('', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/validate/{uuid}', 'validateData')->name('validate');
    });

    Route::controller('MahasiswaController')
        ->prefix('/mahasiswa')
        ->name('mahasiswa.')
        ->group(function() {
            Route::get('', 'index')->name('index');
            Route::get('/render/{divisi_uuid}', 'render')->name('render');
            Route::get('/validate/{uuid}', 'validateData')->name('validate');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
