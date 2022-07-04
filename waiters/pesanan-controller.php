<?php

include "../koneksi.php";

$type = $_POST['type'];
$message = "";

switch ($type) {

    // Add data
  case "masuk keranjang":
    $nomor_meja = $_POST['nomor_meja'];
    $id_menu = $_POST['id_menu'];
    //cek data
    $cek = "SELECT * FROM keranjang WHERE nomor_meja = '" . $nomor_meja . "' AND id_menu = $id_menu AND status = 'Belum dipesan'";
    $result = mysqli_query($koneksi, $cek);
    if ($result) {
      if (mysqli_num_rows($result) == 0) {
        $sql_simpan = "INSERT INTO keranjang (nomor_meja, id_menu, jumlah, created_date, status) VALUES ('$nomor_meja', $id_menu, 1, curdate(), 'Belum Dipesan')";
        $query_simpan = $koneksi->query($sql_simpan) or die('Unable to execute query. ' . mysqli_error($koneksi));
      }
      $message = "Berhasil menambahkan ke keranjang!";
    } else {
      $message  = "Gagal menambahkan ke keranjang!";
    }
    break;

  case "buat pesanan":
    $nomor_meja = $_POST['nomor_meja'];
    $nama_pelanggan = $_POST['nama'];
    $total_harga = 0;
    $status = "Dipesan";

    $id_pesanan = 0;

    //cek pesanan apakah ada atau tidak
    $sql_cek = "SELECT id FROM pesanan WHERE status NOT IN ('Selesai', 'Ditolak') AND nomor_meja = '" . $nomor_meja. "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
    $jumlah_pesanan = mysqli_num_rows($query_cek);

    if ($jumlah_pesanan > 0) {
      $message = $message . " jumlah_pesanan jumlah_pesanan : !" . $jumlah_pesanan;
      $id_pesanan = $data_cek['id'];
      $sql_delete = "DELETE FROM pesanan_detail WHERE id_pesanan = $id_pesanan";
      $query_hapus = mysqli_query($koneksi, $sql_delete);

      for ($i = 0; $i < count($_POST['txtNamaMenu']); $i++) {
        $id_menu = $_POST["txtIdMenu"][$i];
        $nama_menu = $_POST["txtNamaMenu"][$i];
        $jumlah = floatval($_POST["jumlah"][$i]);
        $harga = floatval($_POST["txtHarga"][$i]);
        $subtotal = $jumlah * $harga;
        $query = "INSERT INTO pesanan_detail (id_pesanan, id_menu, nama_menu, jumlah, harga) 
        VALUES ($id_pesanan, $id_menu, '$nama_menu', $jumlah, $subtotal)";
        $query_simpan = mysqli_query($koneksi, $query);
        $total_harga += $subtotal;

        updateStatusKeranjang($koneksi, $i);
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
          $id_menu = $_POST["txtIdMenu"][$i];
          $nama_menu = $_POST["txtNamaMenu"][$i];
          $jumlah = floatval($_POST["jumlah"][$i]);
          $harga = floatval($_POST["txtHarga"][$i]);
          $subtotal = $jumlah * $harga;
          
          $query_detail = "INSERT INTO pesanan_detail (id_pesanan, id_menu, nama_menu, jumlah, harga) 
          VALUES ($id_pesanan, $id_menu, '$nama_menu', $jumlah, $subtotal)";
          $query_simpan_detail = $koneksi->query($query_detail) or die('Unable to execute query. ' . mysqli_error($koneksi));
          $total_harga += $subtotal;
          $message = $message. "querys lopping" . $query_simpan_detail;
          updateStatusKeranjang($koneksi, $i);
        }
        
        $message = $message . " selsai";
      }
    }

    //update total
    $sql_update = "UPDATE pesanan SET total_harga = $total_harga WHERE id = $id_pesanan";
    $query_edit = mysqli_query($koneksi, $sql_update);

    $message = " Berhasil menambahkan ke keranjang!";
    break;

    // Ubah data
  case "Ubah Data":
    $harga = floatval($_POST['newHarga']);
    $id = (int)$_POST['newId'];
    $clause = " ";

    if (isset($_FILES['gambar']['name']) && $_FILES['gambar']['name'] != "") {
      $file_exist = "../uploads/menu/$id/old";
      if (!file_exists($file_exist)) {
        mkdir($file_exist, 0777, true);
      }

      $file_name = $_POST['newGambar'];
      $source_file = "../uploads/menu/$id/$file_name";
      $dest_file = "../uploads/menu/$id/old/$file_name";

      rename_win($source_file, $dest_file);
      move_uploaded_file($_FILES['gambar']['tmp_name'], '../uploads/menu/' . $id . '/' . $_FILES['gambar']['name']);

      $clause = $clause . ", gambar = '" . $_FILES['gambar']['name'] . "' ";
    }

    $queryupdateatt = "UPDATE menu set nama_menu = '" . $_POST['newNama'] . "', 
    jenis = '" . $_POST['newJenis'] . "', 
    harga = " . $harga . "
    $clause
    where id = $id";

    $koneksi->query($queryupdateatt) or die('Unable to execute query. ' . mysqli_error($koneksi));
    $message = "Berhasil Mengubah Data!";
    break;


  default:
    $message = "gagal";
    break;
}

echo $message;



function rename_win($oldfile, $newfile)
{
  if (!rename($oldfile, $newfile)) {
    if (copy($oldfile, $newfile)) {
      unlink($oldfile);
      return TRUE;
    }
    return FALSE;
  }
  return TRUE;
}

function updateStatusKeranjang($koneksi, $i)
{
  $id = $_POST['txtIdKeranjang'][$i];
  //update status di keranjang.
  $sql_update_status_keranjang = "UPDATE keranjang SET status = 'Dipesan' WHERE id = $id";
  $query_edit_status_keranjang = mysqli_query($koneksi, $sql_update_status_keranjang);
}
