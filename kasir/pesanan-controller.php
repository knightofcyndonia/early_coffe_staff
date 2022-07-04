<?php
include "../koneksi.php";

$type = $_POST['type'];
$message = "";


switch ($type) {
    case "ganti status pesanan":
        $status = $_POST['status'];
        $id_pesanan = $_POST['id_pesanan'];
        $nomor_meja = $_POST['nomor_meja'];

        $queryupdateatt = "UPDATE pesanan SET status = '$status' WHERE id = $id_pesanan";
        $koneksi->query($queryupdateatt) or die('Unable to execute query. ' . mysqli_error($koneksi));

        if ($status == "Selesai" || $status == "Ditolak") {
            $queryupdateatt = "UPDATE keranjang SET status = '$status' WHERE nomor_meja = $nomor_meja AND status = 'Dipesan' ";
            $koneksi->query($queryupdateatt) or die('Unable to execute query. ' . mysqli_error($koneksi));
            $message = $message . " status masuk sini" . $queryupdateatt;
        }
        $message = "Konfirmasi Berhasil!";
        break;

    case "buat pesanan dari kasir":
        $nomor_meja = $_POST['txtNomorMeja'];
        $nama_pelanggan = $_POST['txtNama'];
        $total_harga = 0;
        $id_pesanan = 0;
        $status = "Dipesan";

        //cek pesanan apakah ada atau tidak
        $sql_cek = "SELECT id FROM pesanan WHERE status NOT IN ('Selesai', 'Ditolak') AND nomor_meja = " . $nomor_meja;
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
        $jumlah_pesanan = mysqli_num_rows($query_cek);

        if ($jumlah_pesanan > 0) {
            $message = $message . " jumlah_pesanan jumlah_pesanan : !" . $jumlah_pesanan;
            $id_pesanan = $data_cek['id'];
            $sql_delete = "DELETE FROM pesanan_detail WHERE id_pesanan = $id_pesanan";
            $query_hapus = mysqli_query($koneksi, $sql_delete);

            for ($i = 0; $i < count($_POST['txtNamaMenu']); $i++) {
                $id_menu = $_POST["ddlMenu"][$i];
                $nama_menu = $_POST["txtNamaMenu"][$i];
                $jumlah = floatval($_POST["txtJumlah"][$i]);
                $harga = floatval($_POST["txtHarga"][$i]);
                $subtotal = $jumlah * $harga;
                $query = "INSERT INTO pesanan_detail (id_pesanan, id_menu, nama_menu, jumlah, harga) 
                    VALUES ($id_pesanan, $id_menu, '$nama_menu', $jumlah, $subtotal)";
                $query_simpan = mysqli_query($koneksi, $query);
                $total_harga += $subtotal;
            }
        } else {
            $query = "INSERT INTO pesanan (nama_pelanggan, tanggal, nomor_meja, total_harga, status) 
                VALUES ('$nama_pelanggan', curdate(), '$nomor_meja', $total_harga, 'Dipesan')";
            $query_simpan = $koneksi->query($query);
            $id_pesanan = $koneksi->insert_id;
            $message = "masusssk";
            if ($query_simpan) {
                $message = $message . " masuk";
                for ($i = 0; $i < count($_POST['txtNamaMenu']); $i++) {
                    $id_menu = $_POST["ddlMenu"][$i];
                    $nama_menu = $_POST["txtNamaMenu"][$i];
                    $jumlah = floatval($_POST["txtJumlah"][$i]);
                    $harga = floatval($_POST["txtHarga"][$i]);
                    $subtotal = $jumlah * $harga;

                    $query_detail = "INSERT INTO pesanan_detail (id_pesanan, id_menu, nama_menu, jumlah, harga) 
                    VALUES ($id_pesanan, $id_menu, '$nama_menu', $jumlah, $subtotal)";
                    $query_simpan_detail = $koneksi->query($query_detail) or die('Unable to execute query. ' . mysqli_error($koneksi));
                    $total_harga += $subtotal;
                    $message = $message . "querys lopping" . $query_simpan_detail;
                }

                $message = $message . " selsai";
            }
        }

        //update total
        $sql_update = "UPDATE pesanan SET total_harga = $total_harga WHERE id = $id_pesanan";
        $query_edit = mysqli_query($koneksi, $sql_update);

        $message = "Pesanan berhasil dibuat!";
        break;

    case "tampil data pesanan dari nomor meja":
        $listPesanan = [];
        $nomor_meja = $_POST['nomor_meja'];

        $query = "SELECT id, nama_pelanggan, DATE_FORMAT(tanggal,'%d/%m/%Y') AS tanggal, nomor_meja, total_harga 
            FROM pesanan 
            WHERE status NOT IN ('Selesai', 'Ditolak') AND DATE(tanggal) = DATE(curdate()) AND nomor_meja = '$nomor_meja' LIMIT 1";
        $sql = $koneksi->query($query);
        while ($data = $sql->fetch_assoc()) {
            $pesanan = new \stdClass();
            $pesanan->id = $data['id'];
            $pesanan->nama_pelanggan = $data['nama_pelanggan'];
            $pesanan->nomor_meja = $data['nomor_meja'];
            $pesanan->tanggal = $data['tanggal'];
            $pesanan->total_harga = $data['total_harga'];

            $query_detail = "SELECT * 
            FROM pesanan_detail
            WHERE id_pesanan = $pesanan->id";
            $sql_detail = $koneksi->query($query_detail);

            $list_pesanan_detail = [];
            while ($data_detail = $sql_detail->fetch_assoc()) {
                $pesanan_detail = new \stdClass();
                $pesanan_detail->id = $data_detail['id'];
                $pesanan_detail->nama_pesanan = $data_detail['nama_menu'];
                $pesanan_detail->jumlah = $data_detail['jumlah'];
                $pesanan_detail->harga = $data_detail['harga'];
                array_push($list_pesanan_detail, $pesanan_detail);
            }

            $pesanan->list_pesanan_detail = $list_pesanan_detail;

            array_push($listPesanan, $pesanan);
        }
        echo json_encode($listPesanan);
        break;
}


echo $message;
