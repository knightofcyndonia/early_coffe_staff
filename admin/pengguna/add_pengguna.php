<section class="content-header">
	<h1>
		Pengguna Sistem
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
					<h3 class="box-title">Tambah Pengguna</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus"></i>
						</button>
						<button type="button" class="btn btn-box-tool" data-widget="remove">
							<i class="fa fa-remove"></i>
						</button>
					</div>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form action="" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label for="nama_pengguna">Nama Pengguna</label>
							<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama pengguna" maxlength="50" required>
						</div>

						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Username" maxlength="50" required>
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" name="email" id="email" class="form-control" placeholder="Email" maxlength="50" required>
						</div>

						<div class="form-group">
							<label for="phone">Nomor Telepon</label>
							<input type="text" name="phone" id="phone" class="form-control" placeholder="Nomor Telepon" maxlength="20" required>
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" maxlength="20" required>
						</div>

						<div class="form-group">
							<label>Level</label>
							<select name="level" id="level" class="form-control" required>
								<option value="">-- Pilih Level --</option>
								<option value="konsultan">Konsultan</option>
								<option value="admin">Staff Admin</option>
							</select>
						</div>

					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
						<a href="?page=MyApp/data_pengguna" title="Kembali" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
	$date = date('Y-m-d H:i:s');
        $sql_simpan = "INSERT INTO tbl_user (nama, username, email, phone, password,level, created_date, status) VALUES (
        '".$_POST['nama']."',
        '".$_POST['username']."',
		'".$_POST['email']."',
		'".$_POST['phone']."',
        '".$_POST['password']."',
        '".$_POST['level']."',
		'".$date."',
		'ACTIVE'
		)";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
        window.location = 'index.php?page=MyApp/data_pengguna';
        }
      })</script>";
	} else{
		$error_message = $query_simpan;
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '$error_message',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
        window.location = 'index.php?page=MyApp/add_pengguna';
        }
      })</script>";
    }
     //selesai proses simpan data
}
?>

<!-- Js file -->
<script>
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

</script>
