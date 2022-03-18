<?php
include "inc/koneksi.php";
   
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Registrasi | Sistem Informasi Jadwal Rapat Koordinasi Berbasis Web Pusrenpros BP BATAM</title>
	<link rel="icon" href="dist/img/logo.jpeg">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<h3>
				<font color="#2331b4">
					<b>Sistem Informasi Jadwal Rapat Koordinasi Berbasis Web Pusrenpros BP BATAM</b>
				</font>
			</h3>
			</a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<center>
				<img src="dist/img/logo.jpeg" width=160px />
			</center>
			<br>
			<p class="login-box-msg">Registrasi</p>
			<form action="#" method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="nama" placeholder="Nama" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="email" placeholder="Email" required>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="phone" placeholder="Phone" required>
					<span class="glyphicon glyphicon-phone  form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="username" placeholder="Username" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password" placeholder="Password" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				
				<div class="row">
					<div class="col-xs-8">
						Sudah memiliki akun?<a href="lupa_password.php">Login disini</a>
					</div>
				</div>

				<br/>

				<div class="row">
					<div class="col-xs-8">

					</div>
					<!-- /.col -->
					<div class="col-xs-4">
						<button type="submit" class="btn btn-success btn-block btn-flat" name="btnRegistrasi" title="Masuk Sistem">
							<b>Masuk</b>
						</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
			<!-- /.social-auth-links -->

		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 2.2.3 -->
	<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!-- sweet alert -->
</body>

</html>


<?php 
	if (isset($_POST['btnRegistrasi'])) {  

		$nama=mysqli_real_escape_string($koneksi,$_POST['nama']);
		$email=mysqli_real_escape_string($koneksi,$_POST['email']);
		$phone=mysqli_real_escape_string($koneksi,$_POST['phone']);
		$username=mysqli_real_escape_string($koneksi,$_POST['username']);
		$password=mysqli_real_escape_string($koneksi,$_POST['password']);
		
		$sql_email = "SELECT * FROM tbl_user WHERE BINARY username='$username'";
		$sql_username = "SELECT * FROM tbl_user WHERE BINARY email='$email'";

		// $data_login = mysqli_fetch_array($query_login,MYSQLI_BOTH);

		$query_email = mysqli_query($koneksi, $sql_email);
		$query_username = mysqli_query($koneksi, $sql_email);
		$jumlah_email = mysqli_num_rows($query_email);
		$jumlah_username = mysqli_num_rows($query_username);
        

		if ($jumlah_email > 0 ){
              echo "<script>
                    Swal.fire({title: 'Email Sudah Ada',text: 'Mohon gunakan email lain',icon: 'error',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                        }
                    })</script>";
		}	
		else if($jumlah_username > 0){
			echo "<script>
				Swal.fire({title: 'Username sudah ada',text: 'Mohon gunakan username lain',icon: 'error',confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
					}
				})</script>";
		}

		else{
			$created_date = date('Y-m-d H:i:s');
			$level = 'konsultan';
			$status = 'ACTIVE';
			$sql_simpan = "INSERT INTO tbl_user (nama, email, phone, username, password, created_date, level, status) VALUES (
								'".$nama."',
								'".$email."',
								'".$phone."',
								'".$username."',
								'".$password."',
								'".$created_date."',
								'".$level."',
								'".$status."'
							)";

			$query_simpan = $koneksi->query($sql_simpan);
			
			if($query_simpan)
			{

				echo "<script>
				Swal.fire({title: 'Registrasi Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
						window.location = 'login.php';
					}
				})</script>";
			}
			else{
				
				echo "<script>
						Swal.fire({title: 'Registrasi gagal',text: '$query_simpan',icon: 'error',confirmButtonText: 'OK'
						}).then((result) => {
							if (result.value) {
							}
						})</script>";
					}
		}
	}
