@extends('layouts.mahasiswa.layout')
@section('nama', 'Husein Muhammad')

@section('content')

<style>
    .product__item__pic {
        transition: linear;
    }
</style>
<!-- Product Section Begin -->

<div class="container" style="margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Notifikasi</h3>
                </div>
                <div class="card-body">
                    @foreach($listNotifikasi as $notif)
                    <div class="form-group">
                        <label>
                            @if($notif['status_pesanan'] == 'Diterima')
                            Pihak Koperasi Telah Menerima Pesanan {{$notif['nama']}} anda
                            @elseif($notif['status_pesanan'] == 'Ditolak')
                            Pihak Koperasi Telah Menolak Pesanan {{$notif['nama']}} anda
                            @endif
                        </label>
                        <br>
                        <i class="fas fa-calendar-alt"></i> <label class=" text-muted text-sm float-">{{date_format(new DateTime($notif['created_date']),"d F Y")}}</label>
                        <hr>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    Kembali ke <a href="/home">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Product Section End -->


<!-- Js Plugins -->
<script src="{{asset('')}}client/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('')}}client/js/bootstrap.min.js"></script>
<script src="{{asset('')}}client/js/jquery.nice-select.min.js"></script>
<script src="{{asset('')}}client/js/jquery.nicescroll.min.js"></script>
<script src="{{asset('')}}client/js/jquery.magnific-popup.min.js"></script>
<script src="{{asset('')}}client/js/jquery.countdown.min.js"></script>
<script src="{{asset('')}}client/js/jquery.slicknav.js"></script>
<script src="{{asset('')}}client/js/mixitup.min.js"></script>
<script src="{{asset('')}}client/js/owl.carousel.min.js"></script>
<script src="{{asset('')}}client/js/main.js"></script>

<script>
    $(function() {
        $("#nav-home").addClass("active");
    });

    function fnOpenProdukDetail(id) {
        location.href = '/produk-detail/' + id;
    }
</script>