@extends('layouts.admin.master')
@section('title', 'Pemesanan Mahasiswa Detail')
@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">

            <form method="post" action="/admin/konfirmasi">
            <input type="hidden" name="aksi" id="aksi" readonly />
            <input type="hidden" name="id_pemesanan" id="id_pemesanan" value="{{$id}}" readonly />
            <input type="hidden" name="id_user" id="id_user" value="{{$user['id']}}" readonly />
            <input type="hidden" name="id_produk" id="id_produk" value="{{$produk['id']}}" readonly />
            @csrf
            <div class="row">
                <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">{{$produk['nama']}}</h3>
                <div class="col-12">
                    <img src="{{image_url(). $listImage[0]['image_file']}}" class="product-image" alt="Product Image">
                </div>
                <div class="col-12 product-image-thumbs">
                    @foreach($listImage as $image)
                        <div class="product-image-thumb active"><img src="{{image_url(). $image['image_file']}}" alt="Product Image"></div>
                    @endforeach
                </div>
                </div>
                <div class="col-12 col-sm-6">
                <h3 class="my-3">{{$produk['nama']}}</h3>
                <p>{{$produk['deskripsi']}}</p>

                <hr>

                <h4 class="mt-3">Nama Pemesan :  {{$user['nama']}}</h4>
                <h4 class="mt-3">Jurusan/Prodi  :  {{$user['jurusan']}} / {{$user['prodi']}}</h4>
                <h4 class="mt-3">Size :  {{$pesanan['size']}}</h4>
                <h4 class="mt-3">Tanggal Pemesanan :  {{date_format(new DateTime($pesanan['created_at']),"d F Y")}}</h4>
                <h4 class="mt-3">Status :  {{$pesanan['status']}}</h4>

                <div class="mt-4">
                    @if($pesanan['status'] == 'Diajukan')
                    <button type="button" class="btn btn-warning btn-lg btn-flat" name="Diterima" value="Diterima" onclick="fnSubmit('terima')">
                    Terima
                    </button>

                    <button type="button" class="btn btn-danger btn-lg btn-flat" name="Ditolak" value="Ditolak" onclick="fnValidation()">
                    Tolak
                    </button>

                    @elseif($pesanan['status'] == 'Diterima')
                    <button type="button" class="btn btn-success btn-lg btn-flat" name="Ditolak" value="Ditolak" onclick="fnSubmit('selesai')">
                    Selesai
                    </button>

                    @endif
                    <button type="button" class="btn btn-primary btn-lg btn-flat" name="Ditolak" value="Ditolak" onclick="javascript:location.href='/admin/pemesanan_mahasiswa'">
                    Kembali
                    </button>

                </div>

                </div>
            </div>

            <div class="row mt-4">
                <label>Catatan dari mahasiswa</label>
                <textarea class="form-control" readonly>{{$pesanan['catatan']}}</textarea>
            </div>

            <div class="row mt-4">
                <label>Catatan (wajib ditulis apabila menolak pemesanan)</label>
                <textarea class="form-control" id="txtcatatan" name="txtcatatan"></textarea>
            </div>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
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

<script>
    $(function () {
        $("#nav-item-pemesanan_mahasiswa").addClass("active");

        //image
        $('.product-image-thumb').on('click', function () {
        var $image_element = $(this).find('img')
        $('.product-image').prop('src', $image_element.attr('src'))
        $('.product-image-thumb.active').removeClass('active')
        $(this).addClass('active')
        })
    });

    function fnValidation()
    {
        if($("#txtcatatan").val() === "") {
            alert("Harap isi catatan apabila ingin menolak pesanan!"); $("#txtcatatan").focus();
            return false;
        } 
        fnSubmit('tolak');
    }

    function fnSubmit(aksi)
    {        
        if(confirm("Apakah anda yakin ingin " + aksi + " pesanan?"))
        {
            $("#aksi").val(aksi);
            $("form").submit();
        }
    }
</script>