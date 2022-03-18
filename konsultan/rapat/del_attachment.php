<?php

$id = $_GET['id'];
$page = $_GET['page_direct'];
$file_name = $_GET['file_name'];
$userid = $_GET['user_id'];
$id_rapat = $_GET['id_rapat'];
$status = $_GET['status'];

if(isset($id)){

    //pindahin file
 
    // if (!file_exists('uploads/rapat/temp_upload/'. $userid. '/deleted')) {
    //     mkdir('uploads/rapat/temp_upload/'. $userid. '/deleted', 0777, true);
    // }
    
    if (!file_exists('uploads/rapat/deleted/')) {
        mkdir('uploads/rapat/deleted/', 0777, true);
    }

    $source_file = "uploads/rapat/$id_rapat/".$file_name;
    $source_file_temp = "uploads/rapat/temp_upload/$userid/".$file_name;
    $dest_file = 'uploads/rapat/deleted/'.$file_name;
    rename_win($source_file, $source_file_temp, $dest_file, $status);

    $sql_hapus = "UPDATE tbl_rapat_attachment SET
        status='DELETED' 
        WHERE id=".$id."";
    $query_hapus = mysqli_query($koneksi, $sql_hapus) or die(mysqli_error($koneksi));

    $windowslocation = '';
    if($page == 'edit_rapat')
    {
        $windowslocation = 'index.php?page=MyApp/'.$page.'&kode='.$id_rapat;
    }
    else{
        $windowslocation = 'index.php?page=MyApp/'.$page;
    }

    if ($query_hapus) {
        echo "<script>
        Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = '$windowslocation';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Hapus Data Gagal',text: '',ico : 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/$page';
            }
        })</script>";
    }
}

function rename_win($oldfile, $oldfiletemp, $newfile, $status) {

    $userid = $_GET['user_id'];
    $id_rapat = $_GET['id_rapat'];

    if($status == 'TEMP') $oldfile = $oldfiletemp;

    if (!rename($oldfile, $newfile)) {
        if (copy ($oldfile, $newfile)) {
            unlink($oldfile);
            return TRUE;
        }
        return FALSE;
    }
    return TRUE;
}

