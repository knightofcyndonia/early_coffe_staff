@extends('layouts.admin.master')
@section('title', 'Pemesanan Mahasiswa')
@section('content')

<div class="container-fluid">   

  <!-- SELECT2 EXAMPLE -->
  <form method="POST" action="{{url ('admin/pemesanan_mahasiswa')}}">
  @csrf
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Filter</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Jurusan</label>
              <select class="form-control select2bs4" style="width: 100%;" id="ddlJurusan" name="ddlJurusan" onchange="fnJurusanOnChange(this.value)">
                  <option value="">ALL</option>
                  @foreach($listjurusan as $jurusan)
                  <option value="{{$jurusan['id']}}" 
                  @if($jurusan['id'] == $param_jurusan)
                  selected
                  @endif
                  > {{$jurusan['jurusan']}}</option>
                  @endforeach
                  </select>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>Prodi</label>
              <select class="form-control select2bs4" style="width: 100%;" id="ddlProdi" name="ddlProdi">
              <option value="">ALL</option>
              </select>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control select2bs4" style="width: 100%;" name="ddlStatus">
                <option value="">ALL</option>
                <option value="Diajukan" {{$param_status == 'Diajukan' ? 'SELECTED' : ''}}>Diajukan</option>
                <option value="Diterima"{{$param_status == 'Diterima' ? 'SELECTED' : ''}}>Diterima</option>
                <!-- <option value="Selesai"{{$param_status == 'Selesai' ? 'SELECTED' : ''}}>Selesai</option> -->
              </select>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>Filter</label>
              <button class="form-control btn btn-outline-secondary">Submit</button>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
    </div>
  </form>
  <!-- /.card -->
  
  
<div class="row">
  
  <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Daftar Nama-Nama Pemesanan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Prodi</th>
                <th>Tanggal Pemesanan</th>
                <th>Status</th>
                <th>Lihat Detail</th>
              </tr>
            </thead>

            <tbody>
              @foreach($list_pemesanan as $key=>$pemesanan)
              <tr>
                <td>{{ ++$key }}</td>
                <td>{{$pemesanan['nim']}}</td>
                <td>{{$pemesanan['nama']}}</td>
                <td>{{$pemesanan['jurusan']}}</td>
                <td>{{$pemesanan['prodi']}}</td>
                <td>{{date_format(new DateTime($pemesanan['created_at']),"d F Y")}}</td>
                <td>{{$pemesanan['status']}}</td>
                <td><a href="#" onclick="fnDetail({!!json_encode($pemesanan['id'])!!})">Lihat Detail</a></td>
              </tr>
              @endforeach
            </tbody>

            <tfoot>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Prodi</th>
                <th>Tanggal Pemesanan</th>
                <th>Status</th>
                <th>Lihat Detail</th>
              </tr>
            </tr>
            </tfoot>
        </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
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
<!-- Select2 -->
<script src="{{asset('')}}assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('')}}assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="{{asset('')}}assets/plugins/moment/moment.min.js"></script>
<script src="{{asset('')}}assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="{{asset('')}}assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="{{asset('')}}assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('')}}assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="{{asset('')}}assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('')}}assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('')}}assets/dist/js/demo.js"></script>

<!-- page script -->
<script>
  $(function () {
    fnSetSelect();
    fnDataTable();
    $("#nav-item-pemesanan_mahasiswa").addClass("active");

    fnJurusanOnChange($("#ddlJurusan").val());
    $("#ddlProdi").val({{$param_prodi}});
  });
  
  function fnDetail(id)
  {
    location.href = "/admin/pemesanan_mahasiswa/" + id;  
  }

  function fnJurusanOnChange(id){
    var listprodi = {!! json_encode($listprodi) !!};
    var prodi_byjurusanid = listprodi.filter(function (el){
      return el.id_jurusan == id.toString()
    });

    $("#ddlProdi .opt-prodi").remove();
    
    $.each(prodi_byjurusanid, function(i, item){
      $("#ddlProdi").append($('<option>', {
        value : item.id,
        text : item.prodi,
        class : 'opt-prodi'
      }));
    });
  }

  function fnDataTable(){
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  }
  function fnSetSelect()
  {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  }
</script>