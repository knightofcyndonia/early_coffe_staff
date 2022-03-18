<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function dashboard(){
        checkSession();
        checkIsUserAdmin();
        $total_mahasiswa = Http::withToken(getSession()['token'])->get(apiUrl().'/mahasiswa/total')->json()['data'];
        $total_pemesanan = Http::withToken(getSession()['token'])->get(apiUrl().'/pemesanan/total_pemesanan_mahasiswa')->json()['data'];
        $total_cetak_laporan = Http::withToken(getSession()['token'])->get(apiUrl().'/pemesanan/total_cetak_laporan')->json()['data'];
        $total_produk = Http::withToken(getSession()['token'])->get(apiUrl().'/produk/total')->json()['data'];

        $jumlahNotifString = getJumlahNotifAdmin();
        $listNotifs = getListNotifAdmin();

        $listNotif = $listNotifs[0];
        $listNotifStok = $listNotifs[1];
    
        $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);

        $chart = Http::withToken(getSession()['token'])->get(apiUrl().'/pemesanan/chart')->json()['data'];

        return view('admin.home')->with(compact('total_mahasiswa', 'total_pemesanan', 'total_produk', 
        'total_cetak_laporan', 'chart', 'jumlahNotif', 'listNotif', 'listNotifStok'));
    }

    function tampil_notifikasi()
    {
        // $jumlahNotif = getJumlahNotifAdmin();
        // $listNotif = getListNotifAdmin();
        $jumlahNotifString = getJumlahNotifAdmin();
        $listNotifs = getListNotifAdmin();

        $listNotif = $listNotifs[0];
        $listNotifStok = $listNotifs[1];
    
        $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);


        return view('admin.notifikasi')->with(compact('jumlahNotif', 'listNotif', 'listNotifStok'));
    }
}
