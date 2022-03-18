<?php

namespace App\Http\Controllers\Komentar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KomentarController extends Controller
{
    public function proses_komentar(Request $request)
    {
        checkSession();
        $user = getUser();
        $response = Http::withToken(getSession()['token'])->post(apiUrl().'/komentar/proses', [
            'id_produk' => $request->input('id_produk'),
            'id_user' => $request->input('id_user'),
            'comment' => $request->input('komentar')
        ]);

        $message = $response->json()['message'];
        $id_produk = $request->input('id_produk');

        echo("<script>alert('$message'); location.href = 'produk-detail/$id_produk'</script>");
    }
}
