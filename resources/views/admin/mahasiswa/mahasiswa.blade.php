@extends('layouts.admin.master')
@section('title', 'Daftar Mahasiswa')
@section('content')

<div class="container-fluid">   

  <!-- SELECT2 EXAMPLE -->
    <form method="POST" action="{{url ('/admin/mahasiswa')}}">
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
                <label>Jurusan </label>
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
            </div>
            <!-- /.col -->
            <div class="col-md-6">
            <div class="form-group">
                <label>Prodi</label>
                <select class="form-control select2bs4" style="width: 100%;" id="ddlProdi" name="ddlProdi" value="{{$param_prodi}}">
                
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
            <h3 class="card-title">Daftar Nama-Nama Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Prodi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($listmahasiswa as $key=>$mahasiswa)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{$mahasiswa['nim']}}</td>
                        <td>{{$mahasiswa['nama']}}</td>
                        <td>{{$mahasiswa['jurusan']}}</td>
                        <td>{{$mahasiswa['prodi']}}</td>
                    </tr>
                    @endforeach
                </tbody>
                
                <tfoot>
                    <tr>
                        <th>NO</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Prodi</th>
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
<script src="{{asset('')}}assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('')}}assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('')}}assets/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('')}}assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('')}}assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('')}}assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('')}}assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('')}}assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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
    $("#nav-item-mahasiswa").addClass("active");

    fnJurusanOnChange($("#ddlJurusan").val());
    $("#ddlProdi").val({{$param_prodi}});
  });

  function fnJurusanOnChange(id){
    var listprodi = {!! json_encode($listprodi) !!};
    // var listprodi = {{ json_encode($listprodi)   }};
    var prodi_byjurusanid = listprodi.filter(function (el){
      return el.id_jurusan == id.toString()
    });

    $("#ddlProdi option").remove();
    $("#ddlProdi").append($('<option>', {
        value : '',
        text : 'All'
      }));

    $.each(prodi_byjurusanid, function(i, item){
      $("#ddlProdi").append($('<option>', {
        value : item.id,
        text : item.prodi
      }));
    });
  }

  function fnDataTable(){
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  }
  
  function fnSetSelect()
  {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  }
</script>