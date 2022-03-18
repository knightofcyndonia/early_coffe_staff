<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use stdClass;

class ProdukController extends Controller
{
    public function admin_produk(Request $request){
        checkSession();
        checkIsUserAdmin();
        $param_jurusan = $request->ddlJurusan;
        $param_prodi = $request->ddlProdi;
        
        $data = Http::withToken(getSession()['token'])->get(apiUrl().'/produk/list')->json();
        $listjurusan = $data['listjurusan'];
        $listprodi = $data['listprodi'];
        $listproduk = Http::withToken(getSession()['token'])->get(apiUrl().'/produk/list')->json()['listproduk'];
        $jumlahNotifString = getJumlahNotifAdmin();
        $listNotifs = getListNotifAdmin();

        $listNotif = $listNotifs[0];
        $listNotifStok = $listNotifs[1];
    
        $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);

        return view('admin.produk.produk')->with(compact('listjurusan', 'listprodi', 'listproduk', 
            'param_jurusan', 'param_prodi', 'jumlahNotif', 'listNotif', 'listNotifStok'));
    }

    public function filter_admin_produk(Request $request){
        checkSession();
        checkIsUserAdmin();
        $param_jurusan = $request->ddlJurusan;
        $param_prodi = $request->ddlProdi;
        
        $data = Http::withToken(getSession()['token'])->get(apiUrl().'/produk/list', [
            'ddlJurusan' => $param_jurusan,
            'ddlProdi' => $param_prodi
        ])->json();

        $listjurusan = $data['listjurusan'];
        $listprodi = $data['listprodi'];
        $listproduk = $data['listproduk'];

        $jumlahNotifString = getJumlahNotifAdmin();
        $listNotifs = getListNotifAdmin();

        $listNotif = $listNotifs[0];
        $listNotifStok = $listNotifs[1];
    
        $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);

        return view('admin.produk.produk')->with(compact('listjurusan', 
        'listprodi', 'listproduk', 'param_jurusan', 'param_prodi', 'jumlahNotif', 'listNotif', 'listNotifStok'));
    }

    public function admin_tambah_produk(){
        checkSession();
        checkIsUserAdmin();
        
        $listjurusan = Http::withToken(getSession()['token'])->get(apiUrl().'/list-jurusan')->json()['listjurusan'];
        $listprodi = Http::withToken(getSession()['token'])->get(apiUrl().'/list-prodi')->json()['listprodi'];

        $jumlahNotifString = getJumlahNotifAdmin();
        $listNotifs = getListNotifAdmin();

        $listNotif = $listNotifs[0];
        $listNotifStok = $listNotifs[1];
    
        $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);

        return view('admin.produk.tambah_produk')->with(compact('listjurusan', 'listprodi', 'jumlahNotif', 'listNotif', 'listNotifStok'));
    }

    function admin_edit_produk($id)
    {
        checkSession();
        checkIsUserAdmin();
        $listjurusan = Http::withToken(getSession()['token'])->get(apiUrl().'/list-jurusan')->json()['listjurusan'];
        $listprodi = Http::withToken(getSession()['token'])->get(apiUrl().'/list-prodi')->json()['listprodi'];

        $produk = Http::withToken(getSession()['token'])->get(apiUrl().'/produk/produkById', ['produkId' => $id])->json()['data'];
        $produkData = $produk["produkData"];
        $listStok = $produk["stok"];
        $listimage = $produk["image"];
        $jumlahNotifString = getJumlahNotifAdmin();
        $listNotifs = getListNotifAdmin();

        $listNotif = $listNotifs[0];
        $listNotifStok = $listNotifs[1];
    
        $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);

        return view('admin.produk.edit_produk')->with(compact('listjurusan', 'listprodi', 
        'produkData', 'listStok', 'listimage', 'jumlahNotif', 'listNotif', 'listNotifStok'));
    }

    public function hapus_produk($id)
    {
        checkSession();
        checkIsUserAdmin();
        $message =  Http::withToken(getSession()['token'])->post(apiUrl().'/produk/delete', ['produk_id' => $id])->json()['message'];
        return redirect('/admin/produk')->with('message', $message);
    }

    public function admin_tambah_produk_process(Request $request)
    {
        checkSession();
        checkIsUserAdmin();
        $listStock = [];
        $count = count($request->txtstok);

        for($i=0;$i<$count;$i++)
        {
            array_push($listStock, (object)[
                'size' => $request->txtsize[$i],
                'stok' => $request->txtstok[$i],
                'detail' => $request->txtdetail[$i]
            ]);

        }

        $listImage =[];
        $countImage = count($request->gambar);

        for($i=0;$i<$countImage;$i++)
        {
            array_push($listImage, (object)[
                'image' => $request->gambar[$i]
            ]);
        }

        $listDeletedImage = [];

        $message = Http::withToken(getSession()['token'])->post(apiUrl().'/produk/addProduk2', [
            'nama_produk' => $request->input('txtNama'),
            'id_jurusan' => $request->input('ddlJurusan'),
            'id_prodi' => $request->input('ddlProdi'),
            'jenis_jas' => $request->input('ddlJenis'),
            'deskripsi_produk' => $request->input('txtdeskripsi'),
            'listStok' => $listStock,
            'listImage' => $listImage,
            'listDeletedImage' => $listDeletedImage
        ]);

        return redirect('/admin/produk')->with('message', $message->json()['message']);
    }
    

    public function admin_edit_produk_process(Request $request)
    {
        checkSession();
        checkIsUserAdmin();
        $listStock = [];
        $count = count($request->txtstok);

        for($i=0;$i<$count;$i++)
        {
            array_push($listStock, (object)[
                'size' => $request->txtsize[$i],
                'stok' => $request->txtstok[$i],
                'detail' => $request->txtdetail[$i]
            ]);

        }

        $listImage =[];
        $listDeletedImage = [];
        $listInsertedImage = [];

        if($request->gambar != null)
        {
            $countImage = count($request->gambar);
            for($i=0;$i<$countImage;$i++)
            {
                array_push($listImage, (object)[
                    'image' => $request->gambar[$i]
                ]);
            }
        }


        //list inserted image
        if($request->listInsertedImage != null)
        {
            $countImage = count($request->listInsertedImage);
            for($i=0;$i<$countImage;$i++)
            {
                array_push($listInsertedImage, (object)[
                    'image' => $request->listInsertedImage[$i]
                ]);
            }
        }

        //list deleted image
        if($request->listDeletedImage != null)
        {
            $countImage = count($request->listDeletedImage);
            for($i=0;$i<$countImage;$i++)
            {
                array_push($listDeletedImage, (object)[
                    'image' => $request->listDeletedImage[$i]
                ]);
            }
        }

        $message = Http::withToken(getSession()['token'])->post(apiUrl().'/produk/ubahProduk2', [
            'produk_id' => $request->input('txtprodukid'),
            'nama_produk' => $request->input('txtNama'),
            'id_jurusan' => $request->input('ddlJurusan'),
            'id_prodi' => $request->input('ddlProdi'),
            'jenis_jas' => $request->input('ddlJenis'),
            'deskripsi_produk' => $request->input('txtdeskripsi'),
            'listStok' => $listStock,
            'listImage' => $listImage,
            'listDeletedImage' => $listDeletedImage,
            'listInsertedImage' => $listInsertedImage
        ]);

        $pesan = "";
        if($message->status() == 200)
        {
            $pesan = "Berhasil Mengubah Data!";
        }
        else{
            $pesan = "Gagal Mengubah Data!";
        }

        return redirect('/admin/produk')->with('message', $pesan);
    }
}
