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
}


echo $message;
