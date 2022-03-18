<?php

namespace App\Http\Controllers\Keranjang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function view(Request $request)
    {
        $user = getUser();
        $listNotifikasi = getListNotifMahasiswa($user['id']);
        $totalNotifikasi = getJumlahNotifMahasiswa($user['id']);
        return view('mahasiswa.beranda.beranda')->with(compact('listNotifikasi', 'totalNotifikasi'));
    }
}
