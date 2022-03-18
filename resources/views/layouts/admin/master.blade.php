<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
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
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" role="button">
          <i class="fa" style="font-family: Arial, Helvetica, sans-serif;font-weight: 1;">Admin</i>
        </a>
      </li>
      <input type="hidden" name="imageurl" id="imageurl" value="{{image_url()}}" readonly>
      <input type="hidden" name="apiUrl" id="apiUrl" value="{{apiUrl()}}" readonly>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" onclick="fnNotifOnclick()">
          <i class="far fa-bell"></i>
          @if($jumlahNotif != 0 && $jumlahNotif != null)
          <span class="badge badge-warning navbar-badge">{{$jumlahNotif == null ? 0 : $jumlahNotif}}</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 100%;min-width:400px;">
          <span class="dropdown-item dropdown-header">{{$jumlahNotif == null ? 0 : $jumlahNotif}} Notifikasi</span>
          <div class="dropdown-divider"></div>

          @foreach($listNotifStok as $notif)
          <a href="#" class="dropdown-item">
            <i class="far fa-bell mr-2"></i> Stok {{$notif['nama']}} size {{$notif['size']}} adalah {{$notif['stok']}}
            <br>
          </a>
          <div class="dropdown-divider"></div>
          @endforeach


          @foreach($listNotif as $notif)
          <a href="#" class="dropdown-item">
            <i class="far fa-bell mr-2"></i> {{$notif['nama_user']}} Mengajukan Pesanan
            <br>
            <span class=" text-muted text-sm">{{date_format(new DateTime($notif['created_date']),"d F Y")}}</span>
          </a>
          <div class="dropdown-divider"></div>
          @endforeach
          <a href="/admin/notifikasi" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" role="button" onclick="fnLogout()">
          <i class="fa fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{asset('')}}image/logo.png" alt="AdminLTE Logo" class="brand-image">
      <span class="brand-text font-weight-light" style="margin-left: 22px;">Koperasi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link" id="nav-item-dashboard">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/mahasiswa" class="nav-link" id="nav-item-mahasiswa">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Mahasiswa
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/pemesanan_mahasiswa" class="nav-link" id="nav-item-pemesanan_mahasiswa">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Pemesanan Mahasiswa
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/admin/produk" class="nav-link" id="nav-item-produk">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Produk
                <!-- <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/admin/cetak_laporan" class="nav-link" id="nav-item-cetak_laporan">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Cetak Laporan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('title')</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
              <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @yield('content')
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

  $(function(){

    fnCheckStokForNotification();
    $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        autohide: true,
        delay: 5000
      })
  })
  function fnLogout()
  {
    if (confirm('Apakah anda yakin ingin keluar?')) {
      // Save it!
      location = "{{URL::to('logout')}}";
    }
  }

  function fnNotifOnclick()
  {
    var apiUrl = $("#apiUrl").val();

      $.ajax({
        type: "POST",
        url: apiUrl + "/updateNotif",
        data : {
          'tipe_notif': "PESANAN_MAHASISWA"
        },
        success: function(response){
          $(".navbar-badge").remove();
        }
      })
  }
</script>
