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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['role:admin']], function()
{
Route:: resource('/user','UserController' );
Route:: get('/user/hapus/{id}' , 'UserController@destroy' );
Route::resource('/barang','BarangController');
Route::get('/barang/hapus/{id}','BarangController@destroy');
Route::resource('/agen','AgenController');
Route::get('/agen/hapus/{id}','AgenController@destroy');
Route::resource('/akun','AkunController');
Route::get('/akun/edit/{id}','AkunController@edit');
Route::get('/akun/hapus/{id}','AkunController@destroy');
Route::get('/setting','SettingController@index')->name('setting.transaksi');
Route::post('/setting/simpan','SettingController@simpan');
//Pemesanan 
Route::get('/transaksi', 'PreOrderController@index')->name('preorder.transaksi');
Route::post('/sem/store', 'PreOrderController@store');
Route::get('/transaksi/hapus/{kd_brg}','PreOrderController@destroy');
//Detail Pesan
Route::post('/detail/store', 'DetailOrderController@store');
Route::post('/detail/simpan', 'DetailOrderController@simpan');
//penjualan
Route::get('/penjualan', 'PenjualanController@index')->name('penjualan.transaksi');
Route::get('/penjualan-jual/{id}', 'PenjualanController@edit');
Route::post('/penjualan/simpan', 'PenjualanController@simpan');
Route::get('/penjualan/{id}', 'PenjualanController@pdf')->name('cetak.order_pdf');
Route::get('/datapenjualan', 'DataTransaksiController@index')->name('datapenjualan.transaksi');
Route::get('/create', 'CreateController@index')->name('penjualan.create');
Route::post('/cret/store', 'CreateController@store');


});

//Laporan
Route::resource( '/laporan' , 'LaporanController');
Route::resource( '/laporanpenjualan' , 'LaporanPenjualanController');
Route::resource( '/stok' , 'LapStokController');


//laporan cetak
Route::get('/laporancetak/cetak_pdf', 'LaporanController@cetak_pdf');
Route::get('/laporan/laporanpenjualancetak', 'LaporanPenjualanController@show');

