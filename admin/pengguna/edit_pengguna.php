<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tbl_user WHERE id='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

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
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Ubah Pengguna</h3>
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
							<input type='hidden' class="form-control" name="id" value="<?php echo $data_cek['id']; ?>"
							 readonly/>
						</div>

						<div class="form-group">
							<label>Nama Pengguna</label>
							<input class="form-control" name="nama" value="<?php echo $data_cek['nama']; ?>"
								maxlength="50" required />
						</div>

						<div class="form-group">
							<label>Username</label>
							<input class="form-control" name="username" value="<?php echo $data_cek['username']; ?>"
								maxlength="50" required/>
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

						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" name="password" id="pass" value="<?php echo $data_cek['password']; ?>"
								maxlength="20" required/>
							<input id="mybutton" onclick="change()" type="checkbox" class="form-checkbox"> Lihat Password
						</div>

						<div class="form-group">
							<label>Level</label>
							<select name="level" id="level" class="form-control" required>
								<option value="" disabled>-- Pilih Level --</option>
								<?php
                            //mencek data yg dipilih sebelumnya
                           
                            if ($data_cek['level'] == "konsultan") echo "<option value='konsultan' selected>Konsultan</option>";
                            else echo "<option value='konsultan'>Konsultan</option>";

                            if ($data_cek['level'] == "admin") echo "<option value='admin' selected>Staff Admin</option>";
                            else echo "<option value='admin'>Staff Admin</option>";
        
                        ?>
							</select>
						</div>

					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
						<a href="?page=MyApp/data_pengguna" title="Kembali" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<?php

if (isset ($_POST['Ubah'])){
    //mulai proses ubah
    $sql_ubah = "UPDATE tbl_user SET
        nama='".$_POST['nama']."',
        username='".$_POST['username']."',
        email='".$_POST['email']."',
        phone='".$_POST['phone']."',
        password='".$_POST['password']."',
        level='".$_POST['level']."'
        WHERE id='".$_POST['id']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=MyApp/data_pengguna';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=MyApp/data_pengguna';
          }
      })</script>";
    }

    //selesai proses ubah
}

?>

<script type="text/javascript">
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
</script>