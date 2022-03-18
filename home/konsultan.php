<?php
	$sql = $koneksi->query("SELECT count(id) as process from tbl_rapat where status = 'Submitted'");
	while ($data= $sql->fetch_assoc()) {
	
		$process=$data['process'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id) as rapat from tbl_rapat where status != 'Deleted' and jadwal_rapat != '' ");
	while ($data= $sql->fetch_assoc()) {
	
		$jadwal_rapat=$data['rapat'];
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
		<small>Petugas</small>
	</h1>

	<h3 class="text-center">Selamat Datang di Pusat Perencanaan Program Strategis BP Batam</h3f>
</section>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">

		<div class="col-lg-4 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-blue">
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

		<div class="col-lg-4 col-xs-6">
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

		<div class="col-lg-4 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h4>
						<?= $jadwal_rapat; ?>
					</h4>

					<p>Jadwal Rapat</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="?page=MyApp/data_jadwal" class="small-box-footer">More info
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-xs-12">
		<a href="?page=MyApp/add_rapat">
			<button type="button" class="btn btn-danger btn-block">
				<i class="fa fa-plus"></i>
				Daftar Rapat
			</button>
		</a>
			
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title">Catatan</h3>
					<h2 class="card-title">Dokumen wajib yang harus di scan :</h2>
					<p class="card-text">1. Surat keputusan (SKEP)</p>
					<p class="card-text">2. Surat Perjanjian (SPJ)</p>
					<p class="card-text">3. Penetapan Lokasi (PL)</p>
					<p class="card-text">4. Uwto (UWTO)</p>
					<p class="card-text">5. Akta</p>
					<p class="card-text">6. Gambar Teknis</p>
				</div>
			</div>
		</div>
	</div>
	
</section>