<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{asset('')}}image/logo.png">

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

<style>
    body:not(.sidebar-mini-md) .content-wrapper, body:not(.sidebar-mini-md) .main-footer, body:not(.sidebar-mini-md) .main-header {
        margin-left: 0px;
    }
    .card {
  flex-direction: row;
  align-items: center;
}
.card-title {
  font-weight: bold;
}
.card img {
  width: 40%;
  border-top-right-radius: 0;
  border-bottom-left-radius: calc(0.25rem - 1px);
  height:450px;
  object-fit: cover;
}
@media only screen and (max-width: 768px) {
  a {
    display: none;
  }
  .card-body {
    padding: 0.5em 1.2em;
  }
  .card-body .card-text {
    margin: 0;
  }
  .card img {
    width: 50%;
  }
}
@media only screen and (max-width: 1200px) {
  .card img {
    width: 40%;
  }
}
</style>

<body class="hold-transition sidebar-mini">
  @if ($message != '')
  <script>
    alert('{{ $message}}');
  </script>  
  @endif

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <img src="{{asset('')}}assets/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image" style="width:40px;height:40px;margin-top:-5px"/>
            <span class="brand-text font-weight-light" style="margin-left:15px">Politeknik Negri Batam</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content"><div class="card">
    <img src="{{asset('')}}image/campus.jpg" class="card-img-top" />
    <div class="card-body">
        <h5 class="card-title">Masuk</h5>
        <br>
        <form action="/login" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <select name="level" id="level" class="form-control select2bs4" onchange="fnddlrolechange()">
                    <option value="MAHASISWA">Mahasiswa</option>
                    <option value="KOPERASI">Koperasi</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Masukkan NIM" id="nim" name="nim" required maxlength="20"/>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Masukkan Password" id="password" name="password" required maxlength="50"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" id="btnsubmit" name="btnsubmit" value="Login"/>
            </div>
            <div class="form-group">
                <!-- <a href="#">Lupa Password</a> -->
            </div>
            <div class="form-group">
                Belum memiliki akun? <a href="/registrasi">Buat akun</a>
            </div>
        </form>
    </div>
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer> -->
</div>
<!-- ./wrapper -->
</body>
</html>

<script>
    function fnddlrolechange(){

    }
</script>