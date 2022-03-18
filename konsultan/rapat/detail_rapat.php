<?php
	$rapatId = $_GET['kode'];
	$userid = $_SESSION['ses_id'];
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tbl_rapat WHERE id='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
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

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Detail Rapat</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form action="" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<input type='hidden' class="form-control" name="id" value="<?php echo $data_cek['id']; ?>"
							 readonly/>
						</div>

						<div class="form-group">
							<label>Nama</label>
							<input class="form-control" name="nama" value="<?php echo $data_cek['nama']; ?>"
								maxlength="50" readonly />
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $data_cek['email']; ?>"
							maxlength="50" readonly>
						</div>

						<div class="form-group">
							<label for="phone">Nomor Telepon</label>
							<input type="text" name="phone" id="phone" class="form-control" placeholder="Nomor Telepon" value="<?php echo $data_cek['phone']; ?>"
							maxlength="20" readonly>
						</div>

						<!-- Upload file list -->
						<table id="tbl_attachment" class="table" style="margin-top: 80px;">
                        <thead>
                            <tr>
                            <th scope="col" style="width: 5%;">#</th>
                            <th scope="col" style="width: 70%;">Nama file</th>
                            </tr>
                        </thead>
                        <tbody>

                        <!-- looping untuk menampilkan file lampiran -->
                        <?php
                        //   $query = "SELECT * FROM tbl_rapat_attachment where uploaded_by = $userid AND status = 'ACTIVE' ";
							$query = "SELECT * FROM tbl_rapat_attachment where id_rapat = $rapatId AND status = 'ACTIVE' ";
                          $sql = $koneksi->query($query);
                          $no = 1;
                          while ($data= $sql->fetch_assoc()) {
							$idRapat = $data['id_rapat'];
                            $file_name = $data['file_name'];
                            $url_att = "$base_url/uploads/rapat/$idRapat/$file_name";
                        ?>
                            <tr>
                              <td>
                                <input type="hidden" class="txtAttachmentId" name="txtAttachmentId" value="<?php echo $data['id'] ?>"/>
                                <?php echo $no++; ?>
                              </td>
                              <td><a href="<?php echo $url_att; ?>" target="_blank" rel="noopener noreferrer"><?php echo $file_name ?></a></td>
                            </tr>
                        <?php
                          }
                        ?>
                        </tbody>
                    </table>
                    <!-- end of upload file list -->

					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<a href="javascript:history.back()" title="Kembali" class="btn btn-warning">Kembali</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<script type="text/javascript">
	function change()
	{
		var x = document.getElementById('pass').type;

		if (x == 'password')
		{
			document.getElementById('pass').type = 'text';
			document.getElementById('mybutton').innerHTML;
		}
		else
		{
			document.getElementById('pass').type = 'password';
			document.getElementById('mybutton').innerHTML;
		}
	}


	(function () {
	'use strict'

	// Fetch all the forms we want to apply custom Bootstrap validation styles to
	var forms = document.querySelectorAll('.needs-validation')

	// Loop over them and prevent submission
	Array.prototype.slice.call(forms)
		.forEach(function (form) {
		form.addEventListener('submit', function (event) {
			if (!form.checkValidity()) {
			event.preventDefault()
			event.stopPropagation()
			}

			form.classList.add('was-validated')
		}, false)
		})
	})()
</script>