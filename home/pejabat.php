
<!-- Jquery UI -->
<script src="dist/jqueryui/jquery-ui.js"></script>
<script src="dist/jqueryui/external/jquery/jquery.js"></script>

<?php
	$sql = $koneksi->query("SELECT count(id) as process from tbl_rapat where status != 'deleted' and status = 'Submitted'");
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

<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Dokumen</th>
							<th>Buat Jadwal</th>
							<th>Waktu</th>
						</tr>
					</thead>
					<tbody>

						<?php
                  $no = 1;
                  $sql = $koneksi->query("select * from tbl_rapat where status != 'deleted' and status != 'Returned'");
                  while ($data= $sql->fetch_assoc()) {
                ?>
						<tr>
							<td>
								<?php echo $no++; ?>
							</td>

							<td>
								<?php echo $data['nama']; ?>
								<input type="hidden" class="txtidjadwal" id="txtidjadwal_<?php echo $no; ?>" value="<?php echo $data['id']; ?>"/>
							</td>

							<td>
								<?php 
									$rapatId = $data['id'];
									$query = "SELECT * FROM tbl_rapat_attachment where id_rapat = $rapatId AND status = 'ACTIVE' "; 
									$listatt = $koneksi->query($query);
								// Mulai looping untuk menampilkan dokumen
									while($att= $listatt->fetch_assoc()){
										$file_name = $att['file_name'];
										$url_att = "uploads/rapat/$rapatId/$file_name";
								?>
									<p>
										<a href="<?php echo $url_att ?>" target="_blank" rel="noopener noreferrer"><?php echo $file_name ?></a>
									</p>
								<?php
									}
								?>
								<!-- berhenti looping untuk menampilkan dokumen -->
							</td>

							<td class="text-center">
								<button title="Jadwal" class="btn btn-primary btnsetjadwal" data-toggle="modal" data-target="#dvmodal" onclick="fnSetModalValueOnClick(this, <?php echo $no; ?>)">
									<i class="glyphicon  glyphicon-plus"></i>
								</button>
							</td>
							<td>
								<?php 
								$jadwalrapat = $data['jadwal_rapat'];
								if($jadwalrapat == null || $jadwalrapat == '')
								{
									$jadwalrapat ='-';
								}

								elseif($jadwalrapat != null)
								{
									$jadwalrapat = date('d-M-Y H:i', strtotime($data['jadwal_rapat']));
								}
								echo $jadwalrapat 
								?>
							</td>
						</tr>
						<?php
                  }
                ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="dvmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Buat Jadwal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- /.box-header -->
					<!-- form start -->
					<form action="" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<input type='hidden' class="form-control" name="txtid" id="txtid" value=""
									readonly/>
							</div>
							
							<div class="row">
								<!-- Date -->
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label>Tanggal:</label>
											
											<input type="text" id="tanggal" name="tanggal" class="form-control datePicker" readonly required/>
											<!-- <i class="fa fa-calendar"></i> -->
									</div>
								</div>

								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label>Waktu:</label>
										<input type="time" id="waktu" name="waktu" class="form-control timepicker" required />
									</div>
								</div>
						</div>
						<!-- /.box-body -->

						<div class="box-footer">
							<input type="submit" name="Ubah" value="Ubah" class="btn btn-success" id="btnsubmit">
							<a href="" title="Kembali" class="btn btn-warning" data-dismiss="modal">Batal</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>	

<style>
.ui-datepicker { position: relative; z-index: 10000 !important; }
</style>

<?php 
if (isset ($_POST['Ubah'])){
    //mulai proses ubah

	$txtId = $_POST['txtid'];
	$tanggal_rapat = $_POST['tanggal'];
	$waktu_rapat = $_POST['waktu'] . ':00';

	$temp_result = strtotime($tanggal_rapat. " ". $waktu_rapat);
	$result = date("Y-m-d H:i:s", $temp_result);
	

	// $result = $result->getTimestamp();

    $sql_ubah = "UPDATE tbl_rapat SET
		jadwal_rapat ='".$result."' 
        WHERE id='".$_POST['txtid']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah) or die(mysqli_error($koneksi));
    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Tambah Waktu Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=pejabat';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Waktu Gagal',text: '' ,icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=pejabat';
          }
      })</script>";
    }

    //selesai proses ubah
}
?>


<script>

	function fnSetModalValueOnClick(element, i)
	{
		var idjadwal = $("#txtidjadwal_" + i).val();
		$("#txtid").val(idjadwal);
	}

	// (function () {
		
	// })

	$(document).ready(function(){
		$("#btnsubmit").click(function(){
			var waktu = $("#waktu");
			var	tanggal = $("#tanggal");
			
			if(tanggal.val() === "" || tanggal === null) {
				alert("Pilih Tanggal Terlebih Dahulu!");
				tanggal.focus();
				return false;
			}
			else if(waktu.val() === "" || waktu === null) {
				alert("Pilih Waktu Terlebih Dahulu!");
				waktu.focus();
				return false;
			}
			else{

			}
		});
	});
</script>