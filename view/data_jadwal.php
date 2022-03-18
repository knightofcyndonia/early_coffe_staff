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

	<?php 
			if($data_level == 'konsultan')
			{
	?>
		<div class="box-header">
			<a href="?page=MyApp/add_rapat" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> 
				Tambah Data
			</a>
		</div>
	<?php 
			}
	?>

		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Dokumen</th>
							<th>Jadwal</th>
							<th>Waktu</th>
							<th>View</th>
						</tr>
					</thead>
					<tbody>

						<?php
                  $no = 1;
                  $sql = $koneksi->query("select * from tbl_rapat where status != 'deleted' and (jadwal_rapat != '' or jadwal_rapat != null) ");
                  while ($data= $sql->fetch_assoc()) {
                ?>
						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['nama']; ?>
							</td>
							<td>
								<?php echo $data['email']; ?>
							</td>
							<td>
								<?php echo date('d-M-Y', strtotime($data['jadwal_rapat'])); ?>
							</td>
							<td>
							<?php echo date('h:i', strtotime($data['jadwal_rapat'])); ?>
							</td>
							 <td>
								<a href="?page=MyApp/detail_rapat&kode=<?php echo $data['id']; ?>"
								 title="View" class="btn btn-primary">
									<i class="glyphicon  glyphicon-eye-open"></i>
								</a>
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
</section>