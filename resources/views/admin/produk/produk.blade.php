@extends('layouts.admin.master')
@section('title', 'Produk')
@section('content')

@if (\Session::has('message'))
    <div class="alert alert-success">
        {!! \Session::get('message') !!}
    </div>
@endif

<div class="container-fluid">   

  <!-- SELECT2 EXAMPLE -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Filter</h3>
    </div>
    <!-- /.card-header -->
    <form method="POST" action="{{url ('/admin/produk')}}">
    @csrf
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
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
          <label>Prodi</label>
            <select class="form-control select2bs4" style="width: 100%;" id="ddlProdi" name="ddlProdi">
              <option value="">ALL</option>
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
        <h3 class="card-title">Daftar Nama-Nama Produk</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example1" class="table table table-bordered table-striped">
            <thead>
              <tr>
                <!-- <th></th> -->
                <th>No</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Prodi</th>
                <th>Jenis Jas</th>
                <th>Jumlah</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            @foreach($listproduk as $key=>$produk)
            <tr>
                <!-- <td><input type="checkbox" name="chk_produk_{{$loop->index}}" class="chk_produk_{{$loop->index}}" id="chk_produk"></td> -->
                <td>{{ ++$key}}</td>
                <td>{{$produk['nama']}}</td>
                <td>{{$produk['jurusan']}}</td>
                <td>{{$produk['prodi']}}</td>
                <td>{{$produk['jenis_jas']}}</td>
                <td>{{$produk['jumlah']}}</td>
                <td> 
                    <input type="hidden" readonly class="id_produk" value="{{$produk['id']}}"/>
                    <button type="button" id="btn_delete_{{$key}}" class="btn btn-warning btn_edit " onclick="fnEdit({{$produk['id']}})"><i class="fas fa-edit"></i> Ubah </button>
                    <button type="button" id="btn_edit_{{$key}}" class="btn btn-danger btn_delete " onclick="fnDeleteRow(this)"><i class="fas fa-trash"></i> Hapus </button>
                </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <!-- <th></th> -->
                <th>No</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Prodi</th>
                <th>Jenis Jas</th>
                <th>Jumlah</th>
                <th>Aksi</th>
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

  var listProduk = {!! json_encode($listproduk) !!};
  console.log(listProduk);
  $(function () {
    fnSetSelect();
    fnDataTable();
    $("#nav-item-produk").addClass("active");

    fnJurusanOnChange($("#ddlJurusan").val());
    $("#ddlProdi").val({{$param_prodi}});
  });

  function fnJurusanOnChange(id){
    var listprodi = {!! json_encode($listprodi) !!};
    var prodi_byjurusanid = listprodi.filter(function (el){
      return el.id_jurusan == id.toString()
    });

    $("#ddlProdi option  .opt").remove();
    
    $.each(prodi_byjurusanid, function(i, item){
      $("#ddlProdi").append($('<option>', {
        value : item.id,
        text : item.prodi,
        class : 'opt'
      }));
    });
  }

  function fnEdit(id)
  {
      window.location.href = '/admin/edit_produk/' + id;
  }

  function fnDeleteRow($this)
  {
    var id = $($this).siblings('.id_produk').val();
    var thisproduk = listProduk.find(x => x.id === parseInt(id));
    console.log(thisproduk);
    
    // if (confirm('Apakah anda yakin ingin menghapus produk ini?')) {
    //   if(thisproduk.pemesanan_count > 0)
    //   {
    //     alert("Gagal menghapus produk. Pemesanan masih ada");
    //   }
    //   else{
    //     window.location = "produk_hapus/" + id;
    //   }

    // }

    
    if(thisproduk.pemesanan_count > 0)
    {
      alert("Gagal menghapus produk. Pemesanan masih ada");
    }
    else{
      if (confirm('Apakah anda yakin ingin menghapus produk ini?')) {
        window.location = "produk_hapus/" + id;
      }
    }

  }

  function fnDataTable(){
    // $("#example1").DataTable({
    //   "responsive": true,
    //   "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "buttons": [
        {
          extend : "copy",
          exportOptions: {
              columns: [0,1,2,3,4,5]
          }
        }, 
        {
          extend : "csv",
          exportOptions: {
              columns: [0,1,2,3,4,5]
          }
        },
        {
          extend : "excel",
          exportOptions: {
              columns: [0,1,2,3,4,5]
          }
        }, 
        {
          extend : "pdf",
          exportOptions: {
              columns: [0,1,2,3,4,5]
          }
        }, 
        {
          extend : "print",
          exportOptions: {
              columns: [0,1,2,3,4,5]
          }
        }, 
      ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example1_filter").append('<div><button type="button" class="btn btn-primary" onclick="fnOpenAddData()">Tambah Produk</button><div>');

  }

  function fnOpenAddData(){
    location = 'tambah_produk';
  }
  function fnSetSelect()
  {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  }
</script>