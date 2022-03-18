<?php

include "../../inc/koneksi.php";

$arr_file_types = ['application/pdf'];
$user_id = $_POST['user_id'];

if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "false";
    return;
}
else{
    if (!file_exists('../../uploads/rapat/temp_upload/'. $user_id)) {
        mkdir('../../uploads/rapat/temp_upload/'. $user_id, 0777, true);
    }
     
     
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_name = time() . '_'. $_FILES['file']['name'];
    $file_display_name = $_FILES['file']['name'];
    $file_type =  $_FILES['file']['type'];
    $current_date = date('Y-m-d H:i:s');
    
    $int_user_id =
    
    move_uploaded_file($_FILES['file']['tmp_name'], '../../uploads/rapat/temp_upload/'.$user_id.'/' . time() . '_' . $_FILES['file']['name']);
    
    //query insert ke database
    $sql_simpan = "INSERT INTO tbl_rapat_attachment (file_name, file_display_name, file_type, file_uploaded_at, uploaded_by, status) 
                    VALUES ('$file_name', '$file_display_name', '$file_type', '$current_date', $user_id, 'TEMP')";
    
    $koneksi->query($sql_simpan);
    $last_id = $koneksi->insert_id;
    
    // end of insert database
    
    $response = array($last_id, $file_name, $file_display_name, $file_type);
    
    echo json_encode($response);
}
 
