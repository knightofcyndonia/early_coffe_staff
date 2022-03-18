<section class="content-header">
	<h1>
		Pengguna Sistem
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
			<a href="?page=MyApp/add_pengguna" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove">
					<i class="fa fa-remove"></i>
				</button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Nomor Telepon</th>
							<th>Level</th>
							<th>Tanggal dibuat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php
                  $no = 1;
                  $sql = $koneksi->query("select * from tbl_user where username != 'admin' and status = 'active' ");
                  while ($data= $sql->fetch_assoc()) {
					  $level = $data['level'];
					  if($level == 'konsultan'){
						  $level = 'Konsultan';
					  }
					  elseif($level == 'pejabat'){
						  $level = 'Pejabat Pusrenpros';
					  }
                ?>

						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['nama']; ?>
							</td>
							<td>
								<?php echo $data['username']; ?>
							</td>
							<td>
								<?php echo $data['phone']; ?>
							</td>
							<td>
								<?php echo $level; ?>
							</td>
							<td>
								<?php echo date('d-M-Y', strtotime($data['created_date'])); ?>
							</td>
							<td>
								<a href="?page=MyApp/edit_pengguna&kode=<?php echo $data['id']; ?>"
								 title="Ubah" class="btn btn-success">
									<i class="glyphicon glyphicon-edit"></i>
								</a>
								<a href="?page=MyApp/del_pengguna&kode=<?php echo $data['id']; ?>"
								 onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger">
									<i class="glyphicon glyphicon-trash"></i>
									</>
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