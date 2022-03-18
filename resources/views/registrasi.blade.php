<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrasi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" href="{{asset('')}}image/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('')}}assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
</head>


<body class="hold-transition register-page">
  @if ($message != '')
  <script>
    alert('{{ $message}}');
  </script>  
  @endif
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
        <p class="text-center">
            <b>Registrasi Akun</b>
        </p>
        <!-- <p class="text-center" style="font-size:12px">* wajib diisi</p> -->

      <form action="/registrasi" method="post" id="form" name="form">
      @csrf
        <div class="form-group input-group mb-3">
          <input type="text" id="nim" name="nim" class="form-control" placeholder="NIM" required maxlength="20">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required maxlength="50">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <select class="form-control select2bs4" style="width: 100%;" id="jenis_kelamin" name="jenis_kelamin" required>
              <option value="" selected disabled  >--Pilih Jenis Kelamin--</option>
              <option value="LAKI-LAKI">Laki-Laki</option>
              <option value="PEREMPUAN">Perempuan</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <select class="form-control select2bs4" style="width: 100%;" id="id_jurusan" name="id_jurusan" onchange="fnJurusanOnChange(this.value)" required>
              <option value="" selected disabled>--Pilih Jurusan--</option>
              @foreach($listjurusan as $jurusan)
              <option value="{{$jurusan['id']}}"> {{$jurusan['jurusan']}}</option>
              @endforeach
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <select class="form-control select2bs4" style="width: 100%;" id="id_prodi" name="id_prodi" required>
              <option value="" selected disabled >--Pilih Prodi--</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor Telepon" required maxlength="20">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" id="email" name="email" required maxlength="50">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password" required maxlength="50">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" id="re_password" name="re_password" required maxlength="50">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <input type="hidden" name="level" id="level" value="MAHASISWA" required>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="input-group mb-3" style="margin-top:10px">
        <a href="/login" class="text-center">Saya sudah memiliki akun</a>
      </div>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('')}}assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('')}}assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('')}}assets/dist/js/adminlte.min.js"></script>
<!-- jquery-validation -->
<script src="{{asset('')}}assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset('')}}assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Select2 -->
<!-- <script src="{{asset('')}}assets/plugins/select2/js/select2.full.min.js"></script> -->

</body>
</html>

<script>
   $(function () {
    fnSetSelect();
    fnJurusanOnChange($("#id_jurusan").val());
});

function fnJurusanOnChange(id){
    var listprodi = {!! json_encode($listprodi) !!};
    var prodi_byjurusanid = listprodi.filter(function (el){
      return el.id_jurusan == id.toString()
    });


    $("#id_prodi option.opt_prodi").remove();

    $.each(prodi_byjurusanid, function(i, item){
      $("#id_prodi").append($('<option>', {
        value : item.id,
        class : 'opt_prodi',
        text : item.prodi
      }));
    });
  }


  function fnSetSelect()
  {
    //Initialize Select2 Elements
    // $('.select2').select2();

    
  }
</script>