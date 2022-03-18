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
    // return view('admin.home');
    checkSession();
    if(getSession()['level'] === "MAHASISWA")
    {
        return redirect('/home');
    }
    else if(getSession()['level'] === "KOPERASI")
    {
        return redirect('admin/dashboard');
    }
});

Route::get('/admin', function(){return redirect('admin/dashboard');});


Route::get('/login', 'UserController@login')->name('login');
Route::post('/login', 'UserController@processLogin');

Route::get('/logout', 'UserController@proses_logout');

Route::get('/registrasi', 'UserController@registrasi')->name('registrasi');
Route::post('/registrasi', 'UserController@proses_registrasi')->name('proses_registrasi');


Route::group([
    'prefix' => 'admin'
], function(){
    Route::get('dashboard', 'AdminController@dashboard');
    Route::get('notifikasi', 'AdminController@tampil_notifikasi');
    Route::get('mahasiswa', 'Mahasiswa\MahasiswaController@admin_mahasiswa');
    Route::post('mahasiswa', 'Mahasiswa\MahasiswaController@filter_admin_mahasiswa');
    
    Route::get('pemesanan_mahasiswa', 'Pemesanan\Pemesanan@admin_pemesanan_mahasiswa');
    Route::post('pemesanan_mahasiswa', 'Pemesanan\Pemesanan@filter_admin_pemesanan_mahasiswa');
    Route::post('konfirmasi', 'Pemesanan\Pemesanan@proses_konfirmasi');

    Route::get('pemesanan_mahasiswa/{id}', 'Pemesanan\Pemesanan@admin_pemesanan_mahasiswa_detail');
    
    Route::get('produk', 'Produk\ProdukController@admin_produk');
    Route::post('produk', 'Produk\ProdukController@filter_admin_produk');
    
    Route::get('edit_produk/{id}', 'Produk\ProdukController@admin_edit_produk');
    Route::get('produk_hapus/{id}', 'Produk\ProdukController@hapus_produk');
    Route::get('tambah_produk', 'Produk\ProdukController@admin_tambah_produk');
    Route::post('tambah_produk', 'Produk\ProdukController@admin_tambah_produk_process');
    Route::post('edit_produk', 'Produk\ProdukController@admin_edit_produk_process');

    Route::get('cetak_laporan', 'CetakLaporan\CetakLaporanController@view');
    Route::post('cetak_laporan', 'CetakLaporan\CetakLaporanController@filter');
});

Route::get('/home', 'Beranda\BerandaController@view');
Route::get('/notifikasi', 'Beranda\BerandaController@notifikasi');
Route::get('/produk-detail/', function(){return redirect('/home');});
Route::get('/produk-detail/{id}', 'Produk\ProdukDetailMahasiswaController@view');
Route::post('/pesan', 'Produk\ProdukDetailMahasiswaController@process_pesanan');

Route::get('/pemesanan', 'Pemesanan\Pemesanan@mahasiswa_status_pemesanan');
Route::get('/pemesanan/{id}', 'Pemesanan\Pemesanan@mahasiswa_pemesanan_detail');

Route::get('/ajukan_perubahan', function(){return redirect('/home');});
Route::get('/ajukan_perubahan/{id}', 'Pemesanan\Pemesanan@mahasiswa_ajukan_pesanan');
Route::post('/ajukan_perubahan', 'Pemesanan\Pemesanan@ajukan_perubahan_proses');

Route::post('/komentar', 'Komentar\KomentarController@proses_komentar');

Route::get('/keranjang', 'Keranjang\KeranjangController@view');

