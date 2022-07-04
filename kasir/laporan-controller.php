<?php

include "../koneksi.php";

$type = $_POST['type'];
$message = "";

switch ($type) {
    case "tampil data":
        $listPesanan = [];
        $dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];

        $query = "SELECT id, nama_pelanggan, DATE_FORMAT(tanggal,'%d/%m/%Y') AS tanggal, nomor_meja, total_harga 
            FROM pesanan 
            WHERE status = 'Selesai' AND DATE(tanggal) BETWEEN '$dateFrom' AND '$dateTo'";
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
                $pesanan_detail->nama_pesanan = $data_detail['nama_menu'];
                $pesanan_detail->jumlah = $data_detail['jumlah'];
                array_push($list_pesanan_detail, $pesanan_detail);
            }

            $pesanan->list_pesanan_detail = $list_pesanan_detail;

            array_push($listPesanan, $pesanan);
        }
        echo json_encode($listPesanan);
        break;
}
