<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class MahasiswaController extends Controller
{
    public function admin_mahasiswa(Request $request)
    {
            checkSession();
            checkIsUserAdmin();
            
            $param_jurusan = $request->ddlJurusan;
            $param_prodi = $request->ddlProdi;
            $listdata = Http::withToken(getSession()['token'])->get(apiUrl().'/mahasiswa/list')->json();
                        
            $listjurusan = $listdata['listjurusan'];

            $listprodi = $listdata['listprodi'];
            $listmahasiswa = $listdata['listmahasiswa'];
            $jumlahNotifString = getJumlahNotifAdmin();
            $listNotifs = getListNotifAdmin();
    
            $listNotif = $listNotifs[0];
            $listNotifStok = $listNotifs[1];
        
            $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);

            return view('admin.mahasiswa.mahasiswa')->with(compact('listjurusan', 'listprodi', 'listmahasiswa', 
            'param_jurusan', 'param_prodi', 'jumlahNotif', 'listNotif', 'listNotifStok'));
        // }
    }

    public function filter_admin_mahasiswa(Request $request) 
    {
        checkSession();
        checkIsUserAdmin();
        $param_jurusan = $request->ddlJurusan;
        $param_prodi = $request->ddlProdi;
        
        $listdata = Http::withToken(getSession()['token'])->get(apiUrl().'/mahasiswa/list', [
            "param_jurusan" => $param_jurusan,
            "param_prodi" => $param_prodi
        ])->json();

        $listjurusan = $listdata['listjurusan'];
        $listprodi = $listdata['listprodi'];
        $listmahasiswa = $listdata['listmahasiswa'];

        $jumlahNotifString = getJumlahNotifAdmin();
        $listNotifs = getListNotifAdmin();

        $listNotif = $listNotifs[0];
        $listNotifStok = $listNotifs[1];
    
        $jumlahNotif = (int)$jumlahNotifString + sizeof($listNotifs[1]);

        return view('admin.mahasiswa.mahasiswa')->with(compact('listjurusan', 'listprodi', 
        'listmahasiswa', 'param_jurusan', 'param_prodi', 'jumlahNotif', 'listNotif', 'listNotifStok'));
    }
    
}
