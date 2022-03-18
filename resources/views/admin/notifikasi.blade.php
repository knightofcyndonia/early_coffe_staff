@extends('layouts.admin.master')
@section('title', 'Notifikasi')
@section('content')

<div class="container-fluid">   
  
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Notifikasi</h3>
          </div>

          <div class="card-body">

            @foreach($listNotifStok as $notif)
              <label>Sisa Stok {{$notif['nama']}} size {{$notif['size']}} adalah {{$notif['stok']}}</label>
              <br>
              <hr>
            @endforeach
          
            @foreach($listNotif as $notif)
            <div class="form-group">
                <label>{{$notif['nama_user']}} Mengajukan Pesanan</label>
                <br>
                <i class="fas fa-calendar-alt"></i>  <label class=" text-muted text-sm float-">{{date_format(new DateTime($notif['created_date']),"d F Y")}}</label>
                <hr>
            </div>
            @endforeach
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Kembali ke <a href="/admin/dashboard">Dashboard</a>
          </div>
        </div>
        <!-- /.card -->
    </div>
  </div>
  
        
</div>
<!-- /.container-fluid -->
@endsection



<!-- jQuery -->
<script src="{{asset('')}}assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('')}}assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="{{asset('')}}assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('')}}assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('')}}assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('')}}assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('')}}assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('')}}assets/dist/js/demo.js"></script>
<!-- ChartJS -->
<script src="{{asset('')}}assets/plugins/chart.js/Chart.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#nav-item-dashboard").addClass("active");
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false
    });
    
    bindChart();
  });
</script>