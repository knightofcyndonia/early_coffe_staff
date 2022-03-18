<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        preventSession();
        $message = '';
        return view('login')->with(compact('message'));
    }

    public function processLogin(Request $request)
    {
        preventSession();
        $message = '';
        $validator = Validator::make($request->all(), 
            [
                'nim' => 'required',
                'password' => 'required',
                'level' => 'required'
            ]
        );
        
        if($validator->fails()){
            $message = "Mohon lengkapi NIM dan Password!";
            return view('login')->with(compact('message'));
        }

        $response = Http::post(apiUrl().'/auth/login', [
            'nim' => $request->nim,
            'password' => $request->password,
            'level' => $request->level
        ]);

        
        // return redirect('/login');
        if ($response->status() == 200) {   
            $raw = $response->json();
            setSession($raw['access_token'], $raw['level']);
            // return getSession()['token'];
            if (getSession()['level'] == "MAHASISWA") {
                return redirect('/home');
            } 
            else if (getSession()['level'] == "KOPERASI") {
                return redirect('/admin/dashboard');
            }
        } 
        else {
            $message = "Login gagal!";
            return view('login')->with(compact('message'));
        }
    }

    public function registrasi()
    {
        preventSession();
        $message = '';
        $listjurusan = Http::get(apiUrl().'/list-jurusan')->json()['listjurusan'];
        $listprodi = Http::get(apiUrl().'/list-prodi')->json()['listprodi'];
        return view('registrasi')->with(compact('listjurusan', 'listprodi', 'message'));
    }

    public function proses_registrasi(Request $request)
    {
        preventSession();
        $listjurusan = Http::get(apiUrl().'/list-jurusan')->json()['listjurusan'];
        $listprodi = Http::get(apiUrl().'/list-prodi')->json()['listprodi'];

        $validator = Validator::make($request->all(), 
            [
                'nim' => 'required',
                'nama' => 'required',
                'email' => 'required', 
                'password' => 'required', 
                'no_hp' => 'required', 
                'id_prodi' => 'required', 
                'id_jurusan' => 'required',
                'jenis_kelamin' => 'required', 
                'level' => 'required'
            ]

        );

        if($validator->fails()){
            $message = "Mohon lengkapi form!";
            return view('registrasi')->with(compact('listjurusan', 'listprodi', 'message'));
        }

        $response = Http::post('http://localhost:9000/api/auth/register', [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'email' => $request->email, 
            'password' => $request->password,
            'no_hp' => $request->no_hp, 
            'id_prodi' => $request->id_prodi, 
            'id_jurusan' => $request->id_jurusan, 
            'jenis_kelamin' => $request->jenis_kelamin, 
            'level' => $request->level
        ])->status();
        
        if ($response == 200) {   
            echo "<script>alert('Registrasi Berhasil!');location.href = '/login'</script>";
            // return redirect('/login')->with('alert', 'Registrasi Berhasil!');
        } 
        else {
            $message = "Registrasi gagal!";
            return view('registrasi')->with(compact('listjurusan', 'listprodi', 'message'));
        }
    }

    public function proses_logout()
    {
        unSetSession();
    }
}
