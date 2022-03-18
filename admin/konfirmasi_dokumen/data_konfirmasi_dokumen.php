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
							<th>Email</th>
							<th>Nomor Telepon</th>
							<th>Tanggal dibuat</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php
                  $no = 1;
                  $sql = $koneksi->query("select * from tbl_rapat where status = 'Submitted'");
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
								<?php echo $data['phone']; ?>
							</td>
							<td>
								<?php echo date('d-M-Y', strtotime($data['created_date'])); ?>
							</td>
							<td>
								<?php echo $data['status']; ?>
							</td>
							<td>
								<a href="?page=MyApp/detail_rapat&kode=<?php echo $data['id']; ?>"
								 title="View" class="btn btn-primary">
									<i class="glyphicon  glyphicon-eye-open"></i>
								</a>

							<!-- jika level user adalah bukan admin -->
							<?php 
							if($data_level != 'admin')
							{
							?>
								<a href="?page=MyApp/edit_rapat&kode=<?php echo $data['id']; ?>"
								 title="Ubah" class="btn btn-success">
									<i class="glyphicon glyphicon-edit"></i>
								</a>

							<?php 
							}
							else{
							?>
								<a href="?page=MyApp/konfirmasi_dokument&result=Approved&kode=<?php echo $data['id']; ?>"
								title="Terima" class="btn btn-success">
									<i class="glyphicon glyphicon-ok"></i>
								</a>
								<a href="?page=MyApp/konfirmasi_dokument&result=Returned&kode=<?php echo $data['id']; ?>"
								title="Tolak" class="btn btn-danger">
									<i class="glyphicon glyphicon-remove"></i>
								</a>
							<?php	
							}
							?>

							<!-- jika level user adalah konsultan -->
							<?php
							if($data_level == 'konsultan')
							{
							?>

								<a href="?page=MyApp/del_rapat&kode=<?php echo $data['id']; ?>"
								onclick="return confirm('Apakah anda yakin hapus data ini ?')" 
								title="Hapus" class="btn btn-danger" <?php ($data_level == 'konsultasi') ? '' : 'hidden' ?>>
									<i class="glyphicon glyphicon-trash"></i>
								</a>
							<?php	
								}
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
</section>