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
Route::post('/postlogin', 'AuthController@postlogin')->middleware('redirect.authenticated');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboardatk', 'DashboardController@index')->middleware('admin');

    Route::get('/users', 'UserController@index')->middleware('admin');
    Route::post('/users/create', 'UserController@create')->middleware('admin');
    Route::get('/users/{id}/edit', 'UserController@edit')->middleware('admin');
    Route::post('/users/{id}/update', 'UserController@update')->middleware('admin');
    Route::get('/users/{id}/delete', 'UserController@delete')->middleware('admin');

    Route::get('/barangga', 'BaranggaController@index')->middleware('admin');
    Route::post('/barangga/create', 'BaranggaController@create')->middleware('admin');
    Route::get('/barangga/{id}/edit', 'BaranggaController@edit')->middleware('admin');
    Route::post('/barangga/{id}/update', 'BaranggaController@update')->middleware('admin');
    Route::get('/barangga/{id}/delete', 'BaranggaController@delete')->middleware('admin');
    Route::get('/barangga/exportexcelbarangga', 'BaranggaController@exportexcelmasuk')->middleware('admin');
    Route::get('/barangga/exportpdfbarangga', 'BaranggaController@exportpdfmasuk')->middleware('admin');

    Route::get('/masukga', 'MasukgaController@index')->middleware('admin');
    Route::post('/masukga/create', 'MasukgaController@create')->middleware('admin');
    Route::get('/masukga/{id}/edit', 'MasukgaController@edit')->middleware('admin');
    Route::post('/masukga/{id}/update', 'MasukgaController@update')->middleware('admin');
    Route::get('/masukga/{id}/delete', 'MasukgaController@delete')->middleware('admin');
    Route::get('/masukga/exportexcelmasuk', 'MasukgaController@exportexcelmasuk')->middleware('admin');
    Route::get('/masukga/exportpdfmasuk', 'MasukgaController@exportpdfmasuk')->middleware('admin');

    Route::get('/keluarga', 'KeluargaController@index')->middleware('admin');
    Route::post('/keluarga/create', 'KeluargaController@create')->middleware('admin');
    Route::get('/keluarga/{id}/edit', 'KeluargaController@edit')->middleware('admin');
    Route::post('/keluarga/{id}/update', 'KeluargaController@update')->middleware('admin');
    Route::get('/keluarga/{id}/delete', 'KeluargaController@delete')->middleware('admin');
    Route::get('/keluarga/exportexcelkeluar', 'KeluargaController@exportexcelkeluar')->middleware('admin');
    Route::get('/keluarga/exportpdfkeluar', 'KeluargaController@exportpdfkeluar')->middleware('admin');
    Route::post('/keluarga/exportpdfba', 'KeluargaController@exportpdfba');

    Route::get('/daftar', 'DaftarController@index');
    Route::get('/daftar/exportexcel', 'DaftarController@exportexcel');
    Route::get('/daftar/exportpdf', 'DaftarController@exportpdf');

    Route::get('/laporan', 'LaporanController@index')->middleware('admin');
    Route::get('/laporan/excel', 'LaporanController@excel')->middleware('admin');
    Route::post('/laporan/exportexcellaporan', 'LaporanController@exportexcellaporan')->middleware('admin');
    Route::get('/laporan/pdf', 'LaporanController@pdf')->middleware('admin');
    Route::post('/laporan/exportpdflaporan', 'LaporanController@exportpdflaporan')->middleware('admin');
    Route::post('/laporan/cari', 'LaporanController@cari')->middleware('admin');

    Route::get('/unit', 'UnitController@index')->middleware('admin');
    Route::get('/unit/{id}/list', 'UnitController@list')->middleware('admin');
    Route::post('/unit/create', 'UnitController@create')->middleware('admin');
    Route::get('/unit/{id}/delete', 'UnitController@delete')->middleware('admin');
    Route::post('/unit/{id}/update', 'UnitController@update')->middleware('admin');

    Route::get('/requests', [RequestAtkController::class, 'index'])->name('requests.index')->middleware('staff');
    Route::get('/requests/create', [RequestAtkController::class, 'create'])->name('requests.create')->middleware('staff');
    Route::post('/requests', [RequestAtkController::class, 'store'])->name('requests.store')->middleware('staff');
    Route::get('/requests/{id}/edit', [RequestAtkController::class, 'edit'])->name('requests.edit')->middleware('staff');
    Route::put('/requests/{id}', [RequestAtkController::class, 'update'])->name('requests.update')->middleware('staff');
    Route::delete('/requests/{id}', [RequestAtkController::class, 'destroy'])->name('requests.destroy')->middleware('staff');
    Route::post('/requests/exportpdfba', 'RequestController@exportpdfba');

    Route::get('/validations', [ValidasiAtkController::class, 'index'])->name('validations.index')->middleware('admin');
    Route::get('/validations/{id}/edit', [ValidasiAtkController::class, 'edit'])->name('validations.edit')->middleware('admin');
    Route::put('/validations/{id}', [ValidasiAtkController::class, 'update'])->name('validations.update')->middleware('admin');
    Route::delete('/validations/{id}', [ValidasiAtkController::class, 'destroy'])->name('validations.destroy')->middleware('admin');
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