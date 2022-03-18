<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tbl_rapat WHERE id='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
        
        //mulai proses ubah
        $status = $_GET['result'];
        $id = $_GET['kode'];
        $sql_ubah = "UPDATE tbl_rapat SET
            status='".$status."'
            WHERE id='".$_GET['kode']."'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);
        if ($query_ubah) {
            echo "<script>
        Swal.fire({title: 'Konfirmasi Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_konfirmasi_dokumen';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Konfirmasi Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_konfirmasi_dokumen';
            }
        })</script>";
        }

        //selesai proses ubah
    }
?>