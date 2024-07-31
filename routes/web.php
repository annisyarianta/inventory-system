<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestAtkController;
use App\Http\Controllers\ValidasiAtkController;

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

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/atk', 'AtkController@index');

Route::get('/loginatk', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboardatk', 'DashboardController@index');

    Route::get('/users', 'UserController@index');
    Route::post('/users/create', 'UserController@create');
    Route::get('/users/{id}/edit', 'UserController@edit');
    Route::post('/users/{id}/update', 'UserController@update');
    Route::get('/users/{id}/delete', 'UserController@delete');

    Route::get('/barangga', 'BaranggaController@index');
    Route::post('/barangga/create', 'BaranggaController@create');
    Route::get('/barangga/{id}/edit', 'BaranggaController@edit');
    Route::post('/barangga/{id}/update', 'BaranggaController@update');
    Route::get('/barangga/{id}/delete', 'BaranggaController@delete');
    Route::get('/barangga/exportexcelbarangga', 'BaranggaController@exportexcelmasuk');
    Route::get('/barangga/exportpdfbarangga', 'BaranggaController@exportpdfmasuk');

    Route::get('/masukga', 'MasukgaController@index');
    Route::post('/masukga/create', 'MasukgaController@create');
    Route::get('/masukga/{id}/edit', 'MasukgaController@edit');
    Route::post('/masukga/{id}/update', 'MasukgaController@update');
    Route::get('/masukga/{id}/delete', 'MasukgaController@delete');
    Route::get('/masukga/exportexcelmasuk', 'MasukgaController@exportexcelmasuk');
    Route::get('/masukga/exportpdfmasuk', 'MasukgaController@exportpdfmasuk');

    Route::get('/keluarga', 'KeluargaController@index');
    Route::post('/keluarga/create', 'KeluargaController@create');
    Route::get('/keluarga/{id}/edit', 'KeluargaController@edit');
    Route::post('/keluarga/{id}/update', 'KeluargaController@update');
    Route::get('/keluarga/{id}/delete', 'KeluargaController@delete');
    Route::get('/keluarga/exportexcelkeluar', 'KeluargaController@exportexcelkeluar');
    Route::get('/keluarga/exportpdfkeluar', 'KeluargaController@exportpdfkeluar');
    Route::post('/keluarga/exportpdfba', 'KeluargaController@exportpdfba');

    Route::get('/daftar', 'DaftarController@index');
    Route::get('/daftar/exportexcel', 'DaftarController@exportexcel');
    Route::get('/daftar/exportpdf', 'DaftarController@exportpdf');

    Route::get('/laporan', 'LaporanController@index');
    Route::get('/laporan/excel', 'LaporanController@excel');
    Route::post('/laporan/exportexcellaporan', 'LaporanController@exportexcellaporan');
    Route::get('/laporan/pdf', 'LaporanController@pdf');
    Route::post('/laporan/exportpdflaporan', 'LaporanController@exportpdflaporan');
    Route::post('/laporan/cari', 'LaporanController@cari');

    Route::get('/unit', 'UnitController@index');
    Route::get('/unit/{id}/list', 'UnitController@list');
    Route::post('/unit/create', 'UnitController@create');
    Route::get('/unit/{id}/delete', 'UnitController@delete');
    Route::post('/unit/{id}/update', 'UnitController@update');

    Route::get('/requests', [RequestAtkController::class, 'index'])->name('requests.index');
    Route::get('/requests/create', [RequestAtkController::class, 'create'])->name('requests.create');
    Route::post('/requests', [RequestAtkController::class, 'store'])->name('requests.store');
    Route::get('/requests/{id}/edit', [RequestAtkController::class, 'edit'])->name('requests.edit');
    Route::put('/requests/{id}', [RequestAtkController::class, 'update'])->name('requests.update');
    Route::delete('/requests/{id}', [RequestAtkController::class, 'destroy'])->name('requests.destroy');

    Route::get('/validations', [ValidasiAtkController::class, 'index'])->name('validations.index');
    Route::get('/validations/{id}/edit', [ValidasiAtkController::class, 'edit'])->name('validations.edit');
    Route::put('/validations/{id}', [ValidasiAtkController::class, 'update'])->name('validations.update');
    Route::delete('/validations/{id}', [ValidasiAtkController::class, 'destroy'])->name('validations.destroy');
});

    // Route::get('/inventory', 'InventoryController@index');
    // Route::get('/inventory/{id}/profil', 'InventoryController@profil');
    // Route::post('/inventory/create', 'InventoryController@create');
    // Route::get('/inventory/{id}/edit', 'InventoryController@edit');
    // Route::post('/inventory/{id}/update', 'InventoryController@update');
    // Route::get('/inventory/{id}/delete', 'InventoryController@delete');
    // Route::get('/inventory/exportpdf', 'InventoryController@exportPDF');
    // Route::get('/inventory/exportexcel', 'InventoryController@exportExcel');
    // Route::get('/lokasi/{id}/exportpdfid', 'LokasiController@exportPDFid');
    // Route::get('/lokasi/{id}/exportexcelid', 'LokasiController@exportExcelid');
    // Route::get('/lokasi', 'LokasiController@index');
    // Route::get('/lokasi/{id}/list', 'LokasiController@list');
    // Route::post('/lokasi/create', 'LokasiController@create');
    // Route::get('/lokasi/{id}/delete', 'LokasiController@delete');
    // Route::post('/lokasi/{id}/update', 'LokasiController@update');