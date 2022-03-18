@extends('layouts.admin.master')
@section('title', 'Tambah Produk')
@section('content')

  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{asset('')}}assets/plugins/dropzone/min/dropzone.min.css">

<div class="container-fluid">   

  <!-- SELECT2 EXAMPLE -->
  <div class="card card-default">
    <!-- /.card-header -->
    <form method="POST" action="{{url ('admin/tambah_produk')}}" id="frm" class="frm">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Nama</label>
                <input class="form-control" type="text" placeholder="Nama" id="txtNama" name="txtNama" maxlength="100" required>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-12">
          <div class="form-group">
            <label>Jurusan</label>
            <select class="form-control select2bs4" style="width: 100%;" id="ddlJurusan" name="ddlJurusan" onchange="fnJurusanOnChange(this.value)">
              @foreach($listjurusan as $jurusan)
                <option value="{{$jurusan['id']}}">{{$jurusan['jurusan']}}</option>
              @endforeach
            </select>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-12">
          <div class="form-group">
          <label>Prodi</label>
            <select class="form-control select2bs4" style="width: 100%;" id="ddlProdi" name="ddlProdi">
            </select>
          </div>
          
          <div class="form-group">
          <label>Jenis Jas</label>
            <select class="form-control select2bs4" style="width: 100%;" id="ddlJenis" name="ddlJenis">
              <option value="LAB">Lab</option>
              <option value="ALMAMATER">ALMAMATER</option>
            </select>
          </div>

          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea name="txtdeskripsi" id="txtdeskripsi" cols="30" rows="10" class="form-control" maxlength="500"></textarea>
          </div>

          <!-- /.form-group -->
          <div class="form-group">
            <label>Ukuran dan Stok</label>
            <!-- <button class="form-control btn btn-outline-warning">Edit</button> -->
          </div>
          
          <div class="row">
              <div class="col-md-2">
              <button type="button" onclick="fnAddStok()" class="form-control btn btn-small btn-primary" style=" margin-bottom : 10px">Tambah  <i class="fa fa-plus-circle "></i></button>
              </div>
          </div>
          
          <table class="table table table-bordered " id="tbl_size_and_stock">
            <thead>
              <tr>
                <th style="width:2%!important">No</th>
                <th style="width:25%!important">Size</th>
                <th style="width:25%!important">Stok</th>
                <th style="width:25%!important">Detail</th>
                <th style="width:5%!important">
                  Aksi  
                </th>
              </tr>
            </thead>

            <tbody>              
            </tbody>

            <tfoot hidden>
              <tr>  
              <td style="width:2%!important">No</td>
                <td style="width:25%!important">Size</td>
                <td style="width:25%!important">Stok</td>
                <td style="width:25%!important">Detail</td>
                <td style="width:5%!important">
                  Aksi  
                </td>
              </tr>
            </tfoot>
          </table>

          <!-- File Upload -->
          <div class="row">
              <div class="col-md-4 col-lg-4 col-sm-4">
              <button type="button" onclick="fnAddUpload()" class="form-control btn btn-small btn-primary" style=" margin-top : 20px; margin-bottom:10px">Unggah Gambar  <i class="fa fa-plus-circle "></i></button>
              </div>
          </div>
          <table class="table table-bordered" id="tbl_image">
            <thead>
              <tr>
                <th style="width:2%!important">No</th>
                <th style="width:25%!important" colspan="2">Gambar</th>
                <th style="width:5%!important">
                  Aksi  
                </th>
              </tr>
            </thead>

            <tbody>              
            </tbody>

            <tfoot hidden>
              <tr>
                <td style="width:width:2%!important">No</td>
                <td style="width:width:25%!important" colspan="2">Gambar</td>
                <td style="width:width:5%!important">
                  Aksi  
                </td>
              </tr>
            </tfoot>
          </table>
          <!-- /.form-group -->
          <div class="form-group">
            <div class="row">
              <div class="col-md-8">
                <button class="form-control btn btn-primary" type="button" onclick="fnSubmit()">Submit</button>
              </div>
              <div class="col-md-4">
                <button class="form-control btn btn-warning" type="button" onclick="fnCancel()">Batal</button>
              </div>
            </div>
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
  <!-- /.form-group -->
  <!-- /.card -->
  
  
<div class="row">
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
<!-- dropzonejs -->
<script src="{{asset('')}}assets/plugins/dropzone/min/dropzone.min.js"></script>
<!-- BS-Stepper -->
<script src="{{asset('')}}assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    fnSetSelect();
    
    // fnDataTable();

    fnJurusanOnChange($("#ddlJurusan").val());
    $("#nav-item-produk").addClass("active");
  });

  function fnSubmit()
  {
    if(fnValidation())
    {
      if(confirm("Apakah anda yakin ingin mensubmit data?"))
      {
        $("form").submit();
      }
    }
  }

  function fnValidation()
  {
    var listtxtdetail = $(".txtdetail");
    var listinputgambar = $(".base64_gambar");

    if($("#txtNama").val() === "")
    {
      alert("Mohon isi nama produk!");
      $("#txtNama").focus();
      return false;
    }

    else if($("#txtdeskripsi").val() === "")
    {
      alert("Mohon isi deskripsi produk!");
      $("#txtdeskripsi").focus();
      return false;
    }
    
    else if(listtxtdetail.length < 1)
    {
      alert("Mohon masukkan ukuran dan stok!");
      return false;
    }

    else if(listinputgambar.length < 1)
    {
      alert("Mohon masukkan gambar!");
      return false;
    }

    //cek isi ukuran dan stok
    for(var i = 0; i < listtxtdetail.length; i++)
    {
      var txtsize = $($(".txtsize")[i]);
      var txtstok = $($(".txtstok")[i]);
      var txtdetail = $($(".txtdetail")[i]);

      if(txtsize.val() === "")
      {
        alert("Mohon isi size!");
        txtsize.focus();
        return false;
      }
      else if(txtstok.val() === "")
      {
        alert("Mohon isi stok!");
        txtsize.focus();
        return false;
      }
      else if(txtdetail.val() === "")
      {
        alert("Mohon isi detail!");
        txtdetail.focus();
        return false;
      }
    }

    //cek gambar
    for(var i = 0; i < listinputgambar.length; i++)
    {
        if($($(".base64_gambar")[i]).val() === "")
        {
          alert("mohon masukkan gambar!");
          $($(".input-gambar")[i]).focus();
          return false;
        }
    }

    return true;
  }

  function fnAddStok(){
    $("#tbl_size_and_stock .dataTables_empty").hide();

    var no = $(".trproduk").length + 1;
    $("#tbl_size_and_stock tbody").append(
      '<tr class="trproduk">\
        <td style="width:2%!important" class="tdno">'+no+'</td>\
        <td style="width:25%!important" class="tdsize">\
          <input type="text" id="txtsize_'+no+'" name="txtsize[]" class="txtsize form-control" maxlength="5" required/>\
        </td>\
        <td style="width:25%!important" class="tdstok">\
          <input type="text" id="txtstok_'+no+'" name="txtstok[]" class="txtstok form-control" maxlength="11" onkeypress="validate(event)" required\>\
        </td>\
        <td style="width:25%!important" class="tddetail">\
          <input type="text" id="txtdetail_'+no+'" name="txtdetail[]" class="txtdetail form-control" maxlength="100" required\>\
        </td>\
        <td class="tdaksi" style="width:15%!important">\
            <button type="button" id="btn_delete_'+no+'" class="btn btn-danger btn_delete btn-block" onclick="fnDeleteRow(this, `trproduk`)"><i class="fas fa-trash"></i> Hapus </button>\
        </td>\
      </tr>'
      );
  }

  function fnDeleteRow($this, className)
  {
    $($this).closest('tr').remove();
    reorder_number(className);
  }

  function fnAddUpload($this)
  {
    var no = $(".trimage").length + 1;
    $("#tbl_image tbody").append('\
      <tr class="trimage">\
          <td class="tdNoGambar">'+no+'</td>\
          <td >\
              <input id="gambar_'+no+'" type="file" accept="image/*" class="input-gambar" onchange="convert(`gambar_'+no+'`, `base64_gambar_'+no+'`, `output_gambar_'+no+'`)">\
              <input type="hidden" id="base64_gambar_'+no+'" name="gambar[]" class="base64_gambar" value="">\
          </td>\
          <td  class="tdgambar">\
            <img id="output_gambar_'+no+'" class="p-3 output_gambar" style="max-width: 200px">\
          </td>\
          <td>\
          <button type="button" id="btn_delete_image_'+no+'" class="btn btn-danger btn_delete_image btn-block" onclick="fnDeleteRow(this, `trimage`)"><i class="fas fa-trash"></i> Hapus </button>\
          </td>\
      </tr>\
    ');
    
    reorder_number('trproduk');
  }

  function reorder_number(className)
  {
    var length = $("."+className).length;
    var count = 1;

    if('trproduk'=== className)
    {
      for(var i = 0; i < length; i++)
      {
          $($('.tdno')[i]).text(count);
          $($('.input-gambar')[i]).attr({id: 'gambar_'+count, onchange: 'convert(`gambar_'+count+'`, `base64_gambar_'+count+'`, `output_gambar_'+count+'`)'});
          $($('.base64_gambar')[i]).attr('id', 'base64_gambar_' + count);
          $($('.output_gambar')[i]).attr('id', 'output_gambar_' + count);
          count += 1;
      }
    }
    else if ('trimage' === className)
    {
      for(var i = 0; i < length; i++)
      {
          $($('.tdNoGambar')[i]).text(count);
          count += 1;
      }
    }
  }

  function fnJurusanOnChange(id){
    var listprodi = {!! json_encode($listprodi) !!};
    var prodi_byjurusanid = listprodi.filter(function (el){
      return el.id_jurusan == id.toString()
    });

    $("#ddlProdi option").remove();
    
    $.each(prodi_byjurusanid, function(i, item){
      $("#ddlProdi").append($('<option>', {
        value : item.id,
        text : item.prodi
      }));
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

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  }

  function fnDataTable(){
    $("#tbl_size_and_stock").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  }

  function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

function fnCancel()
{
  if(confirm("Apakah anda yakin ingin keluar?"))
  {
    location = '/admin/produk';
  }
}

function convert(input, base64, output) {
    var fileInput = document.getElementById(input);

    var reader = new FileReader();
    reader.readAsDataURL(fileInput.files[0]);

    reader.onload = function () {
        document.getElementById(base64).value = reader.result;
        document.getElementById(output).src = reader.result;
    };
    reader.onerror = function (error) {
    };
  }

  // function check(){
  //     var form = document.getElementById("form");
  //     if (document.getElementById("base64-screen-image").value.length == 0) {
  //         return alert ("Mohon isi data dengan lengkap.");
  //     }
  //     else {
  //         form.submit();
  //     }
  // }


</script>