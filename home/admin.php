<?php
	$sql = $koneksi->query("SELECT count(id) as process from tbl_rapat where status = 'submitted'");
	while ($data= $sql->fetch_assoc()) {
	
		$process=$data['process'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id) as user from tbl_user where username != 'admin' and status ='ACTIVE'");
	while ($data= $sql->fetch_assoc()) {
	
		$agt=$data['user'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id) as rapat from tbl_rapat where status != 'deleted'");
	while ($data= $sql->fetch_assoc()) {
	
		$rapat=$data['rapat'];
	}
?>

<?php
	// $sql = $koneksi->query("SELECT count(id_sk) as kem from tb_sirkulasi where status='KEM'");
	// while ($data= $sql->fetch_assoc()) {
	
	// 	$kem=$data['kem'];
	// }
?>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard
		<small>Administrator</small>
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">

		<div class="col-lg-6 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h4>
						<?= $process; ?>
					</h4>

					<p>Pending Proses</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="?page=MyApp/data_konfirmasi_dokumen" class="small-box-footer">More info
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>

		<!-- <div class="col-lg-4 col-xs-6">
			small box
			<div class="small-box bg-yellow">
				<div class="inner">
					<h4>
						<?= $agt; ?>
					</h4>

					<p>Anggota</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="?page=MyApp/data_pengguna" class="small-box-footer">More info
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div> -->

		<div class="col-lg-6 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h4>
						<?= $rapat; ?>
					</h4>

					<p>Data Rapat</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="?page=MyApp/data_rapat" class="small-box-footer">More info
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>