<?php

namespace App\Http\Controllers\Pemesanan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class Pemesanan extends Controller
{
    public function admin_pemesanan_mahasiswa(Request $request)
    {
        checkSession();
        checkIsUserAdmin();
        $param_jurusan = $request->ddlJurusan;
        $param_prodi = $request->ddlProdi;
        $param_status = $request->ddlStatus;
        $listjurusan = Http::get(apiUrl().'/list-jurusan')->json()['listjurusan'];
        $listprodi = Http::get(apiUrl().'/list-prodi')->json()['listprodi'];

        $response = Http::withToken(getSession()['token'])->get(apiUrl().'/pemesanan/pemesanan_mahasiswa')->json();
        
        $list_pemesanan = $response['listpemesanan'];

        $jumlahNotifString = getJumlahNotifAdmin();
        $listNotifs = getListNotifAdmin();

        $listNotif = $listNotifs[0];
        $listNotifStok = $listNotifs[1];
    
        $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);

        return view('admin.pemesanan_mahasiswa.pemesanan_mahasiswa')->with(compact('listjurusan', 'listprodi', 
            'param_jurusan', 'param_prodi', 'param_status','list_pemesanan', 'jumlahNotif', 'listNotif', 'listNotifStok' ));
    }

    public function filter_admin_pemesanan_mahasiswa(Request $request)
    {
        checkSession();
        checkIsUserAdmin();
        $param_jurusan = $request->ddlJurusan;
        $param_prodi = $request->ddlProdi;
        $param_status = $request->ddlStatus;

        $listjurusan = Http::get(apiUrl().'/list-jurusan')->json()['listjurusan'];
        $listprodi = Http::get(apiUrl().'/list-prodi')->json()['listprodi'];
        $response = Http::withToken(getSession()['token'])->get(apiUrl().'/pemesanan/pemesanan_mahasiswa', 
            [
                'param_jurusan' => $param_jurusan,
                'param_prodi' => $param_prodi,
                'param_status' => $param_status
        ])->json();

        $list_pemesanan = $response['listpemesanan'];

        $jumlahNotifString = getJumlahNotifAdmin();
        $listNotifs = getListNotifAdmin();

        $listNotif = $listNotifs[0];
        $listNotifStok = $listNotifs[1];
    
        $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);

        return view('admin.pemesanan_mahasiswa.pemesanan_mahasiswa')
            ->with(compact('listjurusan', 'listprodi', 'param_jurusan', 'param_prodi', 
            'param_status', 'list_pemesanan', 'jumlahNotif', 'listNotif', 'listNotifStok'));
    }

    public function admin_pemesanan_mahasiswa_detail($id)
    {
        checkSession();
        checkIsUserAdmin();

        $response = Http::withToken(getSession()['token'])->get(apiUrl().'/pemesanan/getPesananById', ['id_pesanan'=> $id])->json();
        $message = "";
        if($response === null)
        {
            echo "<script>alert('Terjadi masalah!'); location.href = '/';</script>";
        }
        else{
            $message = $response['message'];
            $pesanan = $response['data'];
            $produk = $pesanan['produk'][0];
            $ListStok = $pesanan['list_stok'];
            $listImage = $pesanan['list_image'];

            $user_id = $pesanan['id_user'];

            $user = Http::withToken(getSession()['token'])->get(apiUrl().'/auth/getUserById', ['id'=> $user_id])->json()['data'][0];
            $jumlahNotifString = getJumlahNotifAdmin();
            $listNotifs = getListNotifAdmin();
    
            $listNotif = $listNotifs[0];
            $listNotifStok = $listNotifs[1];
        
            $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);
            return view('admin.pemesanan_mahasiswa.pemesanan_mahasiswa_detail')
            ->with(compact('pesanan', 'produk', 'listImage', 'user', 'id', 'jumlahNotif', 'listNotif', 'listNotifStok'));
        }
    }

    public function proses_konfirmasi(Request $request)
    {
        $catatan = "";
        if($request->catatan == null)
        {
            $catatan = "";
        }

        $aksi = "";

        switch ($request->aksi) {
            case "terima":
                $aksi = "Diterima";
              break;
            case "tolak":
                $aksi = "Ditolak";
              break;
            case "selesai":
                $aksi = "Selesai";
              break;
            default:
              $aksi = "";
          }

          $user_id = 

        $response = Http::withToken(getSession()['token'])->post(apiUrl().'/pemesanan/ubahStatus',
            [
                'id_pesanan' => $request->id_pemesanan,
                'status' => $aksi,
                'user_id' => $request->id_user,
                'id_produk' => $request->id_produk,
                'catatan' => $request->txtcatatan

            ]);

        if($response == null)
        {
            echo "<script>alert('Konfirmasi Gagal dilakukan!');location.href = '/admin/pemesanan_mahasiswa'</script>";
        }
        else{
            if($response->status() == 200)
            {
                echo "<script>alert('Konfirmasi Berhasil dilakukan!');location.href = '/admin/pemesanan_mahasiswa'</script>";
            }
            else{
                echo "<script>alert('Konfirmasi Gagal dilakukan!');location.href = '/admin/pemesanan_mahasiswa'</script>";
            }
        }
    }

    public function mahasiswa_status_pemesanan(Request $request)
    {
        checkSession();
        checkIsUserMahasiswa();
        $user = getUser();
        $listNotifikasi = getListNotifMahasiswa($user['id']);
        $totalNotifikasi = getJumlahNotifMahasiswa($user['id']);

        $response = Http::withToken(getSession()['token'])->get(apiUrl().'/pemesanan/listPesananByUser', ['id_user'=> $user['id']])->json();
        $listPemesanan = $response['data'];
        $host = $request->getHttpHost();
        return view("mahasiswa.pemesanan.status_pemesanan")->with(compact('listPemesanan', 'listNotifikasi', 'totalNotifikasi'));
    }

    public function mahasiswa_pemesanan_detail($id)
    {
        checkSession();
        checkIsUserMahasiswa();
        $response = Http::withToken(getSession()['token'])->get(apiUrl().'/pemesanan/getPesananById', ['id_pesanan'=> $id])->json();

        $message = "";
        if($response === null)
        {
            echo "<script>alert('Terjadi masalah!'); location.href = '/home';</script>";
        }
        else{
            $message = $response['message'];
            $pesanan = $response['data'];
            $produk = $pesanan['produk'];

            $ListStok = $pesanan['list_stok'];
            $listImage = $pesanan['list_image'];

            $user_id = $pesanan['id_user'];
            
            $listNotifikasi = getListNotifMahasiswa($user_id);
            $totalNotifikasi = getJumlahNotifMahasiswa($user_id);
            $user = Http::withToken(getSession()['token'])->get(apiUrl().'/auth/getUserById', ['id'=> $user_id])->json()['data'][0];

            return view('mahasiswa.pemesanan.pemesanan_detail')->with(compact('pesanan', 
                'ListStok', 'listImage', 'produk', 'user', 'listNotifikasi', 'totalNotifikasi'));
        }
    }

    public function mahasiswa_ajukan_pesanan($id)
    {
        checkSession();
        checkIsUserMahasiswa();
        $response = Http::withToken(getSession()['token'])->get(apiUrl().'/pemesanan/getPesananById', ['id_pesanan'=> $id])->json();

        $datalistproduk = Http::withToken(getSession()['token'])->get(apiUrl().'/produk/list')->json();
        $listproduk = $datalistproduk['listproduk'];

        $message = "";
        if($response === null)
        {
            echo "<script>alert('Terjadi masalah!'); location.href = '/home';</script>";
        }
        else{
            $message = $response['message'];
            $pesanan = $response['data'];
            $produk = $pesanan['produk'];

            $ListStok = $pesanan['list_stok'];
            $listImage = $pesanan['list_image'];

            $user = getUser();
            $listNotifikasi = getListNotifMahasiswa($user['id']);
            $totalNotifikasi = getJumlahNotifMahasiswa($user['id']);

            return view('mahasiswa.pemesanan.ajukan_perubahan')->with(compact('pesanan', 'ListStok', 
            'listImage', 'produk', 'listproduk', 'listNotifikasi', 'totalNotifikasi'));
        }
    }

    public function ajukan_perubahan_proses(Request $request)
    {
        $response = Http::withToken(getSession()['token'])->post(apiUrl().'/pemesanan/ubahPesanan',
            [
                'id_produk' => $request->ddlProduk,
                'id_pesanan' => $request->id_pesanan,
                'user_id' => $request->user_id,
                'size' => $request->size,
                'catatan' => $request->catatan,
                'status' => 'Diajukan',
                'id_stok_return' => $request->id_stok_return,
                'stok_id' => $request->stok_id,
                'latest_stok' => $request->latest_stok
            ]);

        if($response === null)
        {
            echo "<script>alert('Terjadi masalah!'); location.href = '/pemesanan';</script>";
        }
        else{
            if($response->status() == 200)
            {
                echo "<script>alert('Berhasil mengubah pesanan!'); location.href = '/pemesanan';</script>";
            }
            else{
                echo "<script>alert('Terjadi masalah!'); location.href = '/pemesanan';</script>";
            }
        }

    }



}
