<?php

//Mulai Sesion
session_start();
if (isset($_SESSION["ses_email"])==""){
	header("location: login.php");

}else{
  $data_id = $_SESSION["ses_id"];
  $data_username = $_SESSION["ses_username"];
  $data_email = $_SESSION["ses_email"];
  $data_level = $_SESSION["ses_level"];
  $data_otp_code = $_SESSION["otp_code"];
}


include "inc/koneksi.php";
   
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login | Sistem Informasi Jadwal Rapat Koordinasi Berbasis Web Pusrenpros BP BATAM</title>
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
			<p class="login-box-msg">Recovery Password</p>
			<form method="post" oninput='txtnewpasswordconfirm.setCustomValidity(txtnewpasswordconfirm.value != txtnewpassword.value ? "Passwords do not match." : "")' >
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="txtotp" placeholder="Masukkan kode OTP" maxlength=4 required>
					<span class="glyphicon form-control-feedback"></span>
				</div>			
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="txtnewpassword" placeholder="Masukkan Password" maxlength="10" required>
					<span class="glyphicon form-control-feedback"></span>
				</div>	
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="txtnewpasswordconfirm" placeholder="Konfirmasi Password" maxlength="10" required>
					<span class="glyphicon form-control-feedback"></span>
				</div>	

				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-success btn-block btn-flat" name="btnsubmit" title="Submit">
							<b>Send Link</b>
						</button>
					</div>
				</div>

                <br>

				<div class="row">
					<div class="col-xs-12 ">
						Remember your password? <a href="login.php">click here</a>
					</div>
				</div>

				<br/>
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
		if (isset($_POST['btnsubmit'])) {  

		// $username=mysqli_real_escape_string($koneksi,$_POST['username']);
		// $password=mysqli_real_escape_string($koneksi,$_POST['password']);
		
			$password = $_POST['txtnewpassword'];
			$txtOtp = $_POST['txtotp'];

			if($txtOtp != $data_otp_code)
			{
			echo "<script>
				Swal.fire({title: 'KODE OTP SALAH!',text: '',icon: 'error',confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
						window.location = 'konfirmasi.php';
					}
				})</script>";
			}
			else{
				$query = "UPDATE tbl_user set password = '$password' where username = '$data_username'";
				$query_ubah = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));

				if($query_ubah){
					echo "<script>
							Swal.fire({title: 'Password Berhasil Di Ubah',text: '',icon: 'success',confirmButtonText: 'OK'
							}).then((result) => {
								if (result.value) {
									window.location = 'index.php';
								}
							})</script>";
					
   					 session_destroy();
				}
				else{
					echo "<script>
						Swal.fire({title: 'Ubah Password Gagal!',text: '',icon: 'error',confirmButtonText: 'OK'
						}).then((result) => {
							if (result.value) {
								window.location = 'konfirmasi.php';
							}
						})</script>";
				}
			}
		}
