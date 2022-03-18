<?php

namespace App\Http\Controllers\CetakLaporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CetakLaporanController extends Controller
{
    public function view(Request $request)
    {
        checkSession();
        checkIsUserAdmin();
        $param_jurusan = $request->ddlJurusan;
        $param_prodi = $request->ddlProdi;
        $param_status = $request->ddlStatus;

        $date_from = date("Y-m-d", strtotime("-1 months"));
        $date_to =date("Y-m-d");

        $listjurusan = Http::get(apiUrl().'/list-jurusan')->json()['listjurusan'];
        $listprodi = Http::get(apiUrl().'/list-prodi')->json()['listprodi'];

        $response = Http::withToken(getSession()['token'])->get(apiUrl().'/pemesanan/cetak_laporan')->json();
        
        $list_pemesanan = $response['listpemesanan'];
        
        $jumlahNotifString = getJumlahNotifAdmin();
        $listNotifs = getListNotifAdmin();

        $listNotif = $listNotifs[0];
        $listNotifStok = $listNotifs[1];
    
        $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);
        

        return view('admin.cetak_laporan.cetak_laporan')->with(compact('listjurusan', 'listprodi', 
        'param_jurusan', 'param_prodi', 'param_status','list_pemesanan',  'date_from', 'date_to', 'jumlahNotif', 'listNotif', 'listNotifStok'));
    }

    public function filter(Request $request)
    {
        checkSession();
        checkIsUserAdmin();

        $param_jurusan = $request->ddlJurusan;
        $param_prodi = $request->ddlProdi;
        $param_status = $request->ddlStatus;
        $param_date_from = $request->date_from;
        $param_date_to = $request->date_to;

        $date_from = $param_date_from . " 00:00:00";
        $date_to = $param_date_to . " 23:59:59";

        $listjurusan = Http::get(apiUrl().'/list-jurusan')->json()['listjurusan'];
        $listprodi = Http::get(apiUrl().'/list-prodi')->json()['listprodi'];
        
        $response = Http::withToken(getSession()['token'])->get(apiUrl().'/pemesanan/cetak_laporan',
            [
                'param_jurusan' => $param_jurusan,
                'param_prodi' => $param_prodi,
                'param_status' => $param_status,
                'date_from' => $date_from,
                'date_to' => $date_to
            ]
        )->json();
        
        $list_pemesanan = $response['listpemesanan'];

        $jumlahNotifString = getJumlahNotifAdmin();
        $listNotifs = getListNotifAdmin();

        $listNotif = $listNotifs[0];
        $listNotifStok = $listNotifs[1];
    
        $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);

        return view('admin.cetak_laporan.cetak_laporan')->with(compact('listjurusan', 'listprodi', 'param_jurusan',
         'param_prodi', 'param_status','list_pemesanan', 'date_from', 'date_to', 'jumlahNotif', 'listNotif', 'listNotifStok' ));
    }
}
