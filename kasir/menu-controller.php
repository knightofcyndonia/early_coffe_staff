<?php

$type = $_POST['type'];
$message = "";

switch($type){
  case "Add Data":
    $message = "Berhasil Menambahkan Data!";
    break;
  case "Ubah Data":
    $message = "Berhasil Mengubah Data!";
    break;
  case "hapus":
    $message = "Berhasil Menghapus Data!";
    break;
  default:
    $message = "Gagal Mengubah Data!";
    break;
}


echo $message;
