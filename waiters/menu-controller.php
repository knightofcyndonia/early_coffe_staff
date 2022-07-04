<?php

include "../koneksi.php";

$type = $_POST['type'];
$message = "";

switch ($type) {

    // Add data
  case "Add Data":
    $harga = floatval($_POST['newHarga']);
    $sql_simpan = "INSERT INTO menu (nama_menu, jenis, harga, gambar) VALUES (
      '" . $_POST['newNama'] . "',
      '" . $_POST['newJenis'] . "',
      '" . $harga . "',
      '" . $_FILES['gambar']['name'] . "'
      )";
    $query_simpan = $koneksi->query($sql_simpan) or die('Unable to execute query. ' . mysqli_error($koneksi));
    $idMenu = $koneksi->insert_id;

    $url_att = "$base_url/uploads/menu/$idMenu/";
    if (!file_exists('../uploads/menu/' . $idMenu)) {
      mkdir('../uploads/menu/' . $idMenu, 0777, true);
    }
    move_uploaded_file($_FILES['gambar']['tmp_name'], '../uploads/menu/' . $idMenu . '/' . $_FILES['gambar']['name']);

    if ($query_simpan) {
      $message = "Berhasil Menambahkan Data!";
    } else {
      $message = "Gagal Menambahkan Data! $query_simpan";
    }

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

      $clause = $clause . ", gambar = '". $_FILES['gambar']['name']. "' ";
    }
    
    $queryupdateatt = "UPDATE menu set nama_menu = '" . $_POST['newNama'] . "', 
    jenis = '" . $_POST['newJenis'] . "', 
    harga = " . $harga . "
    $clause
    where id = $id";

    $koneksi->query($queryupdateatt) or die('Unable to execute query. ' . mysqli_error($koneksi));
    $message = "Berhasil Mengubah Data!";
    break;


    // Hapus data
  case "hapus":
    $id = $_POST['id'];

    $sql_hapus = "DELETE FROM menu WHERE id=" . (int)$id . "";
    $query_hapus = mysqli_query($koneksi, $sql_hapus) or die(mysqli_error($koneksi));

    $message = "Berhasil Menghapus Data!";
    break;
  default:
    $message = "Gagal Mengubah Data!";
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
