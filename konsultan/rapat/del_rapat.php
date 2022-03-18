<?php

$id = $_GET['kode'];
if(isset($id)){
    $sql_hapus = "UPDATE tbl_rapat SET
        status='deleted' 
        WHERE id=".$id."";
    $query_hapus = mysqli_query($koneksi, $sql_hapus) or die(mysqli_error($koneksi));
    // $query_hapus = mysqli_query($koneksi, $sql_hapus);

    if ($query_hapus) {
        echo "<script>
        Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_rapat';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Hapus Data Gagal',text: '',ico : 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_rapat';
            }
        })</script>";
    }
}

