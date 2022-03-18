<?php
include "inc/koneksi.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';
   
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
				<font style="color:#2331b4">
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
			<form action="#" method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="email" placeholder="Email" required>
					<span class="glyphicon glyphicon-email form-control-feedback"></span>
				</div>			

				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-success btn-block btn-flat" name="btnLogin" title="Send Link">
							<b>Send Link</b>
						</button>
					</div>
					<!-- /.col -->
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
		if (isset($_POST['btnLogin'])) {  

		// $username=mysqli_real_escape_string($koneksi,$_POST['username']);
		// $password=mysqli_real_escape_string($koneksi,$_POST['password']);


		// $sql_login = "SELECT * FROM tbl_user WHERE BINARY username='$username' AND password='$password'";
		// $query_login = mysqli_query($koneksi, $sql_login);
		// $data_login = mysqli_fetch_array($query_login,MYSQLI_BOTH);
		// $jumlah_login = mysqli_num_rows($query_login);

		$email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $sql_login = "SELECT * FROM tbl_user WHERE BINARY email='$email' AND status = 'ACTIVE'";
		$query_email = mysqli_query($koneksi, $sql_login);
		$data_email = mysqli_fetch_array($query_email,MYSQLI_BOTH);
		$jumlah_email = mysqli_num_rows($query_email);


		if ($jumlah_email == 1 ){
			session_start();
			$_SESSION["ses_id"]=$data_email["id"];
			// $_SESSION["ses_nama"]=$data_email["nama"];
			$_SESSION["ses_username"]=$data_email["username"];
			$_SESSION["ses_email"]=$data_email["email"];
			$_SESSION["ses_level"]=$data_email["level"];
			
			$levelUser = strtolower($data_email["level"]);

			$otp_code = "1234";
			// $otp_code = rand ( 1000 , 9999);
			$_SESSION["otp_code"]=$otp_code;

			// send_email("huseinmuhammad12345@gmail.com",$otp_code);
			// send_email($data_email["email"], $otp_code);
			
			echo "<script>
				Swal.fire({title: 'Kode Berhasil di Kirim',text: 'Silahkan Cek Email',icon: 'success',confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
						window.location = 'konfirmasi.php';
					}
				})</script>";
			}
			else{
			echo "<script>
				Swal.fire({title: 'Email Tidak Terdaftar',text: '',icon: 'error',confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
						window.location = 'lupa_password.php';
					}
				})</script>";
			}
	}

	function send_email($email,$otp_code)
	{
		$mailsubject = 'Verifikasi Pusrenpros';
		$mail_body = "Code nya adalah $otp_code";
		$email_receiver = $email;
		$name_receiver = 'PUSRENPROS';

		$mail = new PHPMailer;
		// $htmlversion="<p color='red'>This ".$suppName." make some order, this email sent ".$status.", this the content ".$content."</p>";
		$textVersion = "This is the text Version";

		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  				 // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'knightofcyndonia@gmail.com';                 // SMTP username
		$mail->Password = '0778456456';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		$mail->SMTPDebug = 0;
		
		$mail->SMTPOptions = array(
		'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);   

		$mail->setFrom('knightofcyndonia@gmail.com', 'PUSRENPROS (No-Reply)');

		$mail->Subject    = $mailsubject;
		$mail->Body = $mail_body;

		$mail->AddAddress($email_receiver, $name_receiver);
		
		if(!$mail->Send()) {
			echo "Mailer Error1: " . $mail->ErrorInfo;
			$success = false;
		} 
		else {
			$success = true;
		}
		
		$status = $success ? 3 : 2;
		$note = $success ? '' : 'ERROR ON PHP MAILER!';
		$mail_subject = stripslashes($mailsubject);
		$mail_body = stripslashes($mail_body);
		$time = strtotime("now");
		
		return true;
	}
