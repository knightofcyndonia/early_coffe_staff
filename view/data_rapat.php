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
		<div class="box-header">
			<a href="?page=MyApp/add_rapat" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> 
				Tambah Data
			</a>
		</div>
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
                  $sql = $koneksi->query("select * from tbl_rapat where status != 'deleted' ");
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

							<?php 
							if($data_level != 'admin' && $data['status'] != 'Approved')
							{
							?>
								<a href="?page=MyApp/edit_rapat&kode=<?php echo $data['id']; ?>"
								 title="Ubah" class="btn btn-success" <?php ($data_level != 'admin') ? '' : 'hidden' ?>>
									<i class="glyphicon glyphicon-edit"></i>
								</a>

							<?php 
							}

							if($data_level == 'konsultan' && $data['status'] != 'Approved')
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