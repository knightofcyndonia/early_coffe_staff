<?php
    //Mulai Sesion
    session_start();
    if (isset($_SESSION["ses_username"])==""){
		header("location: login.php");
    
    }else{
      $data_id = $_SESSION["ses_id"];
      $data_nama = $_SESSION["ses_nama"];
      $data_user = $_SESSION["ses_username"];
      $data_level = $_SESSION["ses_level"];
    }

    //KONEKSI DB
    include "inc/koneksi.php";
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sistem Informasi Jadwal Rapat Koordinasi Berbasis Web Pusrenpros BP BATAM</title>
	<link rel="icon" href="dist/img/logo.jpeg">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/select2.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- jquery UI -->
	<link href="dist/jqueryui/jquery-ui.css" rel="stylesheet">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body class="hold-transition skin-green sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="index.php?page=<?php echo $data_level; ?>" class="logo">
				<span class="logo-lg">
					<img src="dist/img/logo.jpeg" width="37px">
					<b>PUSRENPROS</b>
				</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->
						<li class="dropdown messages-menu">
							<a class="dropdown-toggle">
								<span>
									<b>
										Sistem Informasi Jadwal Rapat Koordinasi Berbasis Web Pusrenpros BP BATAM
									</b>
								</span>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<!-- =============================================== -->

		<!-- Left side column. contains the sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				</<b>
				<div class="user-panel">
					<div class="pull-left image">
						<img src="dist/img/avatar.png" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>
							<?php echo $data_nama; ?>
						</p>
						<span class="label label-warning">
							<?php echo $data_level; ?>
						</span>
					</div>
				</div>
				</br>
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li class="header">MAIN NAVIGATION</li>

					<!-- Level  -->
					<?php
          if ($data_level=="admin"){
        ?>

					<li class="treeview">
						<a href="?page=admin">
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=MyApp/data_jadwal">
							<i class="fa fa-folder"></i>
							<span>Cek Jadwal</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=MyApp/data_konfirmasi_dokumen">
							<i class="fa fa-folder"></i>
							<span>Konfirmasi Dokumen</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<!-- <li class="treeview">
						<a href="?page=MyApp/data_rapat">
							<i class="fa fa-cog"></i>
							<span>Pengaturan</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li> -->

					<li class="header">SETTING</li>

					<!-- <li class="treeview">
						<a href="?page=MyApp/data_pengguna">
							<i class="fa fa-user"></i>
							<span>Pengguna Sistem</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li> -->

					<?php
          } 
		  elseif($data_level=="konsultan"){
        ?>

					<li class="treeview">
						<a href="?page=konsultan">
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=MyApp/data_jadwal">
							<i class="fa fa-folder"></i>
							<span>Cek Jadwal</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<!-- <li class="treeview">
						<a href="?page=MyApp/data_rapat">
							<i class="fa fa-cog"></i>
							<span>Pengaturan</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li> -->

					<li class="header">SETTING</li>

					<?php
            }
			elseif ($data_level == 'pejabat'){
		?>
					<li class="treeview">
						<a href="?page=pejabat">
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=MyApp/data_jadwal">
							<i class="fa fa-folder"></i>
							<span>Cek Jadwal</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=MyApp/data_rapat">
							<i class="fa fa-cog"></i>
							<span>Pengaturan</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="header">SETTING</li>

					<li class="treeview">
						<a href="?page=MyApp/data_pengguna">
							<i class="fa fa-user"></i>
							<span>Pengguna Sistem</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>
		<?php	
			}
          ?>

					<li>
						<a href="logout.php" onclick="return confirm('Anda yakin keluar dari aplikasi ?')">
							<i class="fa fa-sign-out"></i>
							<span>Logout</span>
							<span class="pull-right-container"></span>
						</a>
					</li>


			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- =============================================== -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<!-- Main content -->
			<section class="content">
				<?php 
      if(isset($_GET['page'])){
        //   $hal = $data_level;
		$hal = $_GET['page'];
  
			switch ($hal) {
				//Klik Halaman Home Pengguna
				case 'admin':
					include "home/admin.php";
					break;
				case 'konsultan':
					include "home/konsultan.php";
					break;
				case 'pejabat':
					include "home/pejabat.php";
					break;
				case '':
					include "home/$hal.php";
					break;
		
				//Pengguna
				case 'MyApp/data_pengguna':
					include "admin/pengguna/data_pengguna.php";
					break;
				case 'MyApp/add_pengguna':
					include "admin/pengguna/add_pengguna.php";
					break;
				case 'MyApp/edit_pengguna':
					include "admin/pengguna/edit_pengguna.php";
					break;
				case 'MyApp/del_pengguna':
					include "admin/pengguna/del_pengguna.php";
					break;
				
				//rapat
				case 'MyApp/data_rapat':
					include "view/data_rapat.php";
					break;
				case 'MyApp/add_rapat':
					include "konsultan/rapat/add_rapat.php";
					break;
				case 'MyApp/edit_rapat':
					include "konsultan/rapat/edit_rapat.php";
					break;
				case 'MyApp/detail_rapat':
					include "konsultan/rapat/detail_rapat.php";
					break;
				case 'MyApp/del_rapat':
					include "konsultan/rapat/del_rapat.php";
					break;
				case 'MyApp/del_attachment':
					include "konsultan/rapat/del_attachment.php";
					break;

				//cek jadwal
				case 'MyApp/data_jadwal' :
					include "view/data_jadwal.php";
					break;				
				
				//konfirmasi dokument
				case 'MyApp/data_konfirmasi_dokumen':
					include "admin/konfirmasi_dokumen/data_konfirmasi_dokumen.php";
					break;
				case 'MyApp/konfirmasi_dokument':
					include "admin/konfirmasi_dokumen/konfirmasi_dokumen.php";
					break;
					
				//default
				default:
					echo "<center><br><br><br><br><br><br><br><br><br>
					<h1> Halaman tidak ditemukan !</h1></center>";
					break;    
          }
      }
	  else{
        // Auto Halaman Home Pengguna
          if($data_level=="admin"){
			include "home/admin.php";
		}
		elseif($data_level=="Petugas"){
			include "home/petugas.php";
		}
	  }
    ?>



			</section>
			<!-- /.content -->
		</div>

		<!-- /.content-wrapper -->

		
		<div class="control-sidebar-bg"></div>

		<!-- ./wrapper -->

		<!-- jQuery 2.2.3 -->
		<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>

		<script src="plugins/select2/select2.full.min.js"></script>
		<!-- DataTables -->
		<script src="plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- Jquery UI -->
		<script src="dist/jqueryui/external/jquery/jquery.js"></script>
		<script src="dist/jqueryui/jquery-ui.js"></script>

		<!-- AdminLTE App -->
		<script src="dist/js/app.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>
		<!-- page script -->


		<script>
			$(function() {
				$(".datePicker").datepicker();
				
				// $(".select2").select2();
				// $("#example1").DataTable();
				// $('#example2').DataTable({
				// 	"paging": true,
				// 	"lengthChange": false,
				// 	"searching": false,
				// 	"ordering": true,
				// 	"info": true,
				// 	"autoWidth": false
				// });
			});
		</script>
</body>

</html>