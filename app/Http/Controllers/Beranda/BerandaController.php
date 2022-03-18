<?php

namespace App\Http\Controllers\Beranda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BerandaController extends Controller
{
    function view()
    {
        checkSession();
        checkIsUserMahasiswa();
        $user = getUser();
        $listNotifikasi = getListNotifMahasiswa($user['id']);
        $totalNotifikasi = getJumlahNotifMahasiswa($user['id']);
        $data = Http::withToken(getSession()['token'])->get(apiUrl().'/produk/list')->json();
        $listproduk = $data['listproduk'];
        return view('mahasiswa.beranda.beranda')->with(compact('listproduk', 'user', 'listNotifikasi', 'totalNotifikasi'));
    }

    function notifikasi()
    {
        checkSession();
        checkIsUserMahasiswa();
        $user = getUser();
        $listNotifikasi = getListNotifMahasiswa($user['id']);
        $totalNotifikasi = getJumlahNotifMahasiswa($user['id']);
        return view('mahasiswa.beranda.notifikasi')->with(compact('user', 'listNotifikasi', 'totalNotifikasi'));
    }
}
