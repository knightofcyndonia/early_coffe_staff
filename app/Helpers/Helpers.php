<?php
   
    use Illuminate\Support\Facades\Session;
    use Illuminate\Http\Request;
    use App\Http\Requests;
    use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

function apiUrl() {
        $url = "http://localhost:9000/api";
        return $url;
    }

    function image_url()
    {
        $url = "http://localhost:9000/storage/";
        return $url;
    }
   
    function setSession($token, $level) {
        session()->put('jas_lab_poltek_token', $token);
        session()->put('jas_lab_poltek_level', $level);
    }

    function checkSession() {
        /*
            kalau misalnya, proses yang membutuhkan session dan mengecek jika session kosong lalu redirect ke login, pake fungsi checkSession(0)
            kalau check session nya ada, pake fungsio checkSession(1)

        */

        if (isset(getSession()["token"]) && !empty(getSession()["token"]) && isset(getSession()["level"]) && !empty(getSession()["level"])) {
            
        } 
        else {
            echo "<script>window.location.href = '/login';</script>";
        }        
    }

    function checkIsUserAdmin()
    {
        if(getSession()["level"] !== 'KOPERASI')
        {
            echo "<script>alert('Error!');window.location.href = '/home';</script>";
        }
    }

    function checkIsUserMahasiswa()
    {
        if(getSession()["level"] !== 'MAHASISWA')
        {
            echo "<script>alert('Error!');window.location.href = '/admin/dashboard';</script>";
        }
    }

    // untuk diletakan di login, register, forgot password
    function preventSession() {
        if (isset(getSession()["token"]) && !empty(getSession()["token"]) && isset(getSession()["level"]) && !empty(getSession()["level"])) {
            if (getSession()['level'] == "MAHASISWA") {
                echo "<script>window.location.href = '/admin/dashboard/';</script>";
            } 
            else if (getSession()['level'] == "KOPERASI") {
                echo "<script>window.location.href = '/admin/dashboard/';</script>";
            }
        }
    }

    function getSession() {
        $token = session()->get('jas_lab_poltek_token');
        $level = session()->get('jas_lab_poltek_level');

        return array("token" => $token, "level" => $level);
    }


    function getUser()
    {
        $user = Http::withToken(getSession()['token'])->get(apiUrl().'/auth/user')->json();
        return $user;
    }

    function unSetSession() 
    {
        session()->forget('jas_lab_poltek_token');
        session()->forget('jas_lab_poltek_level');

        echo "<script>window.location.href = '/login';</script>";
    }

    function getJumlahNotifAdmin()
    {
        return Http::withToken(getSession()['token'])->post(apiUrl().'/jumlahNotif', 
        [
            'tipe_notif' => 'PESANAN_MAHASISWA'
        ])->json()['jumlah_notif'];
    }

    function getListNotifAdmin()
    {
        $listPemesanan = Http::withToken(getSession()['token'])->post(apiUrl().'/getlistNotif', 
        [
            'tipe_notif' => 'PESANAN_MAHASISWA'
        ])->json()['data_notif'];

        
        $listStokLess = Http::withToken(getSession()['token'])->post(apiUrl().'/getStokProdukNotif', 
        [
            'tipe_notif' => 'PESANAN_MAHASISWA'
        ])->json()['data'];

        $listNotif = [];

        array_push($listNotif, $listPemesanan);
        array_push($listNotif, $listStokLess);

        return $listNotif;

        // return Http::withToken(getSession()['token'])->post(apiUrl().'/getlistNotif', 
        // [
        //     'tipe_notif' => 'PESANAN_MAHASISWA'
        // ])->json()['data_notif'];
    }

    function getJumlahNotifMahasiswa($id_user)
    {
        return Http::withToken(getSession()['token'])->post(apiUrl().'/jumlahNotif', 
        [
            'tipe_notif' => 'STATUS_KOPERASI',
            'id_user' => $id_user
        ])->json()['jumlah_notif'];
    }

    function getListNotifMahasiswa($id_user)
    {
        return Http::withToken(getSession()['token'])->post(apiUrl().'/getlistNotif', 
        [
            'tipe_notif' => 'STATUS_KOPERASI',
            'id_user' => $id_user
        ])->json()['data_notif'];
    }