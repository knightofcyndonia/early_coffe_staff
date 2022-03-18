<?php
	$userid = $_SESSION['ses_id'];
	$rapatId = $_GET['kode'];
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tbl_rapat WHERE id='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
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
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Ubah Rapat</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form action="" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<input type='hidden' class="form-control" name="id" value="<?php echo $data_cek['id']; ?>"
							 readonly/>
						</div>

						<div class="form-group">
							<label>Nama</label>
							<input class="form-control" name="nama" value="<?php echo $data_cek['nama']; ?>"
								maxlength="50" required />
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $data_cek['email']; ?>"
							maxlength="50" required>
						</div>

						<div class="form-group">
							<label for="phone">Nomor Telepon</label>
							<input type="text" name="phone" id="phone" class="form-control" placeholder="Nomor Telepon" value="<?php echo $data_cek['phone']; ?>"
							maxlength="20" required>
						</div>

						<div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                <div id="drag_upload_file">
                    <p>Drop file here</p>
                    <p>or</p>
                    <p><input type="button" value="Select File" onclick="file_explorer();"></p>
                    <input type="file" id="selectfile" style="display: none;" />
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
                  $query = "SELECT * FROM tbl_rapat_attachment where (id_rapat = $rapatId AND status = 'ACTIVE') OR ( uploaded_by = $userid AND status != 'DELETED') ";
                  $sql = $koneksi->query($query);
                  $no = 1;
                  while ($data= $sql->fetch_assoc()) {
                    $file_name = $data['file_name'];
					$status = $data['status'];

                    $url_att = "$base_url/uploads/rapat/$rapatId/$file_name";
					if($status == 'TEMP')
					{
						$url_att = "$base_url/uploads/rapat/temp_upload/$userid/$file_name";
					}
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
							<a href="?page=MyApp/del_attachment&id=<?php echo $data['id']; ?>&page_direct=edit_rapat&id_rapat=<?php echo $rapatId?>&file_name=<?php echo $file_name?>&user_id=<?php echo $userid; ?>&status=<?php echo $status ?>"
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

					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
						<a href="?page=MyApp/data_rapat" title="Kembali" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<?php

if (isset ($_POST['Ubah'])){
    //mulai proses ubah
	$idRapat = $_POST['id'];
    $sql_ubah = "UPDATE tbl_rapat SET
        nama='".$_POST['nama']."',
        email='".$_POST['email']."',
        phone='".$_POST['phone']."',
		status='Submitted'  
        WHERE id='".$_POST['id']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

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
      $koneksi->query($queryupdateatt) or die (mysqli_error($koneksi));
    }

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=MyApp/data_rapat';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=MyApp/data_rapat';
          }
      })</script>";
    }

    //selesai proses ubah
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

<script type="text/javascript">
var user_id =  <?php echo $_SESSION["ses_id"]; ?>;

	function change()
	{
		var x = document.getElementById('pass').type;

		if (x == 'password')
		{
			document.getElementById('pass').type = 'text';
			document.getElementById('mybutton').innerHTML;
		}
		else
		{
			document.getElementById('pass').type = 'password';
			document.getElementById('mybutton').innerHTML;
		}
	}


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
        $.ajax({
            type: 'POST',
            url: 'konsultan/rapat/upload_file.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                var data_array = $.parseJSON(response);
                console.log(data_array);

                //deklarasi url image setelah tambah item
                var url_att = window.location.origin + "/pusrenpros/uploads/rapat/temp_upload/" +user_id+ '/' + data_array[1];

                $('#selectfile').val('');
                $("#tbl_attachment tbody").prepend(
                    '<tr>\
                        <td class="td_no">\
						</td>\
                        <td>\
							<a href="'+url_att+'" target="_blank" rel="noopener noreferrer">'+data_array[1]+'</a>\
							<input type="hidden" class="txtAttachmentId" name="txtAttachmentId" value="'+ data_array[0]+ '"/>\
						</td>\
                        <td>\
                        <a href="?page=MyApp/del_attachment&id='+data_array[0]+'&page_direct=edit_rapat&id_rapat=<?php echo $rapatId ?>&file_name='+data_array[1]+'&user_id=<?php echo $userid; ?>&status=TEMP"\
                                onclick="return confirm(\'\Apakah anda yakin hapus data ini ?\'\)" title="Hapus" class="btn btn-danger">\
                                  <i class="glyphicon glyphicon-trash"></i>\
                                  </>\
                        </td>\
                    </tr>'
                );
				fnReorderNumber();
            }
        });
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