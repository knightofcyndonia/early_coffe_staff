<?php 
    $userid = $_SESSION['ses_id'];
?>
<section class="content-header">
	<h1>
		Pusat Perencanaan Program Strategis BP Batam
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php?page=<?php echo $data_level; ?>" >
				<i class="fa fa-home"></i>
				<b>Home</b>
			</a>
		</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Rapat</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form action="" method="post" enctype="multipart/form-data" onsubmit="fnSubmit()" id="frm">
					<div class="box-body">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" maxlength="50" required>
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" name="email" id="email" class="form-control" placeholder="Email" maxlength="50" required>
						</div>

						<div class="form-group">
							<label for="phone">Nomor Telepon</label>
							<input type="text" name="phone" id="phone" class="form-control" placeholder="Nomor Telepon" maxlength="20" required>
						</div>
                        
            <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                <div id="drag_upload_file">
                    <p>Drop file here</p>
                    <p>or</p>
                    <p><input type="button" value="Select File" onclick="file_explorer();"></p>
                    <input type="file" id="selectfile" style="display: none;" accept="application/pdf"/>
                </div>
            </div>
					<!-- /.box-body -->

            <!-- Upload file list -->
            <table id="tbl_attachment" class="table" style="margin-top: 80px;">
                <thead>
                    <tr>
                    <th scope="col" style="width: 5%;">#</th>
                    <th scope="col" style="width: 70%;">Nama file</th>
                    <th scope="col" style="width: 25%;">Action</th>
                    </tr>
                </thead>
                <tbody>

                <!-- looping untuk menampilkan file lampiran -->
                <?php
                  $query = "SELECT * FROM tbl_rapat_attachment where uploaded_by = $userid AND status = 'TEMP' ";
                  $sql = $koneksi->query($query);
                  $no = 1;
                  while ($data= $sql->fetch_assoc()) {
                    $file_name = $data['file_name'];
                    $status = $data['status'];
                    $url_att = "$base_url/uploads/rapat/temp_upload/$userid/$file_name";
                ?>
                    <tr>
                      <td class="td_no">
                        <?php echo $no++; ?>
                      </td>
                      <td>
                        <a href="<?php echo $url_att; ?>" target="_blank" rel="noopener noreferrer"><?php echo $file_name ?></a>
                        <input type="hidden" class="txtAttachmentId" name="txtAttachmentId" value="<?php echo $data['id'] ?>"/>
                      </td>
                      <td>
                      <a href="?page=MyApp/del_attachment&id=<?php echo $data['id']; ?>&page_direct=add_rapat&id_rapat=0
                        &file_name=<?php echo $file_name?>&user_id=<?php echo $userid; ?>&status=<?php echo $status ?>"
                        onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger">
                          <i class="glyphicon glyphicon-trash"></i>
                          </>
                      </td>
                    </tr>
                <?php
                  }
                ?>
                </tbody>
            </table>
            <!-- end of upload file list -->

					<div class="box-footer">
						<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
						<!-- <a href="?page=MyApp/data_rapat" title="Kembali" class="btn btn-warning">Batal</a>4 -->
            <input type="button" value="Batal" value="Batal" class="btn btn-warning" onclick="fnBatalClick()"/>
					</div>
				</form>
			</div>
        </div>
        </div>
    </div>
			<!-- /.box -->
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin memproses form?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-primary" onclick="fnSubmit()">Ya</button>
      </div>
    </div>
  </div>
</div>

<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
	  $date = date('Y-m-d H:i:s');
    $sql_simpan = "INSERT INTO tbl_rapat (nama, email, phone, created_date, status) VALUES (
    '".$_POST['nama']."',
		'".$_POST['email']."',
		'".$_POST['phone']."',
		'".$date."',
		'Submitted'
		)";

    // $query_simpan = mysqli_query($koneksi, $sql_simpan) or die(mysqli_error($koneksi));]\
    $query_simpan = $koneksi->query($sql_simpan);
    $idRapat = $koneksi->insert_id;

    // pindahin file
    $url_att = "uploads/rapat/temp_upload/$userid/";
    if(!file_exists('uploads/rapat/'.$idRapat))
    {
      mkdir('uploads/rapat/'.$idRapat, 0777, true);
    }

    $queryatt = "SELECT * FROM tbl_rapat_attachment where uploaded_by = $userid AND status = 'TEMP'";
    $sqlatt = $koneksi->query($queryatt);
    while ($data= $sqlatt->fetch_assoc()) {
      $file_name = $data['file_name'];
      $source_file = "uploads/rapat/temp_upload/$userid/$file_name";
      $dest_file = "uploads/rapat/$idRapat/$file_name";

      rename_win($source_file, $dest_file);  

      $queryupdateatt = "UPDATE tbl_rapat_attachment set STATUS = 'ACTIVE', id_rapat = $idRapat where uploaded_by = $userid AND STATUS = 'TEMP'";
      $koneksi->query($queryupdateatt);
    }

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
        window.location = 'index.php?page=MyApp/data_rapat';
        }
      })</script>";
	} else{
		$error_message = $query_simpan;
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '$error_message',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
        window.location = 'index.php?page=MyApp/data_rapat';
        }
      })</script>";
    }
     //selesai proses simpan data
}

function rename_win($oldfile,$newfile) {
  if (!rename($oldfile,$newfile)) {
      if (copy ($oldfile,$newfile)) {
          unlink($oldfile);
          return TRUE;
      }
      return FALSE;
  }
  return TRUE;
}

?>

<!-- Js file -->
<script>
var user_id =  <?php echo $_SESSION["ses_id"]; ?>;
function fnSubmit(){
      $("#frm").submit();
}

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()


//upload file
var fileobj;
function upload_file(e) {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj);
}
 
function file_explorer() {
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
        fileobj = document.getElementById('selectfile').files[0];
        ajax_file_upload(fileobj);
    };
}
 
function ajax_file_upload(file_obj) {
    if(file_obj != undefined) {
        var form_data = new FormData();                  
        form_data.append('file', file_obj);
        form_data.append('user_id', user_id)
        console.log(form_data);
        $.ajax({
            type: 'POST',
            url: 'konsultan/rapat/upload_file.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                var data_array = $.parseJSON(response);
                console.log(data_array);

                if(data_array === false)
                {
                  Swal.fire({title: 'Tidak bisa memasukkan file',text: '',icon: 'error',confirmButtonText: 'OK'
                    }).then((result) => {if (result.value){
                      // window.location = 'index.php?page=MyApp/data_rapat';
                      }
                    })
                }
                else{
                  //deklarasi url image setelah tambah item
                  var url_att = window.location.origin + "/pusrenpros/uploads/rapat/temp_upload/" +user_id+ '/' + data_array[1];

                  $('#selectfile').val('');
                  $("#tbl_attachment tbody").prepend(
                      '<tr>\
                          <td class="td_no">\
                          <td>\
                            <a href="'+url_att+'" target="_blank" rel="noopener noreferrer">'+data_array[1]+'</a></td>\
                            <input type="hidden" class="txtAttachmentId" name="txtAttachmentId" value="'+ data_array[0]+ '"/></td>\
                          <td>\
                          <a href="?page=MyApp/del_attachment&id='+data_array[0]+'&page_direct=add_rapat&id_rapat=0&file_name='+data_array[1]+'&user_id=<?php echo $userid; ?>&status=TEMP"\
                                  onclick="return confirm(\'\Apakah anda yakin hapus data ini ?\'\)" title="Hapus" class="btn btn-danger">\
                                    <i class="glyphicon glyphicon-trash"></i>\
                                    </>\
                          </td>\
                      </tr>'
                  );
                  fnReorderNumber();
                }
            }
        });
    }
}

function fnBatalClick()
{
  if(confirm("Apakah anda yakin ingin membatalkan?")){
    window.location.href ="?page=MyApp/data_rapat";
  }
}

function fnReorderNumber(){
	var tdNumber = $(".td_no");
	for (var i = 0; i < tdNumber.length; i++) {
        var count = i + 1;
        $(tdNumber[i]).text(count);
    }
}

</script>

<style>
#drop_file_zone{
    background-color: #EEE;
    border: #999 5px dashed;
    width: 100%;
    height: 200px;
    font-size: 8px;
    font-size: 18px;
}

#drag_upload_file{
    width: 50%;
    margin: 0 auto;
}

#drag_upload_file p{
    text-align: center;
}

#drag_upload_file #selectFile{
    display: none;
}
</style>