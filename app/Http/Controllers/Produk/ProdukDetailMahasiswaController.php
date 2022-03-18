<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProdukDetailMahasiswaController extends Controller
{
    public function view($id, Request $request)
    {
        checkSession();
        checkIsUserMahasiswa();
        $response = Http::withToken(getSession()['token'])->get(apiUrl().'/produk/produkById', ['produkId'=> $id])->json();
        if($response == null)
        {
            echo "<script>alert('Data tidak ditemukan!');location.href = '/home';</script>";
        }
        else{
            $produk = $response['data']['produkData'];
            $ListStok = $response['data']['stok'];
            $listImage = $response['data']['image'];

            $listkomentar = Http::withToken(getSession()['token'])->get(apiUrl().'/komentar/list', ['id_produk'=> $id])->json()['listkomentar'];
   
            $user = getUser();
            $listNotifikasi = getListNotifMahasiswa($user['id']);
            $totalNotifikasi = getJumlahNotifMahasiswa($user['id']);

            return view('mahasiswa.produk_detail.produk_detail')->with(compact('produk', 'ListStok', 
            'listImage', 'id', 'listkomentar', 'listNotifikasi', 'totalNotifikasi'));
        }
    }

    public function process_pesanan(Request $request)
    {
        checkSession();

        $catatan = $request->catatan;
        if($catatan == null) 
        {
            $catatan = "";
        }

        $response = Http::withToken(getSession()['token'])->post(apiUrl().'/pemesanan/addPesanan', 
                [
                    'id_produk' => $request->id_produk,
                    'user_id' => $request->user_id,
                    'size' => $request->size,
                    'catatan' => $catatan,
                    'status' => 'Diajukan',
                    'stok_id' => $request->stok_id,
                    'latest_stok' => $request->latest_stok,
                    'tipe_notif' => 'PESANAN_MAHASISWA'
                ])->json();
        $message = "";
        if($response == null)
        {
            $response['message'] == "Gagal Melakukan pemesanan";
        }
        else{
            $message = $response['message'];
        }
        echo("<script>alert('$message'); location.href = '/home';</script>");

    }
}
