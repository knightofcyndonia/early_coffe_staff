@extends('layouts.mahasiswa.layout')
@section('nama', $user['nama'])

@section('content')

<style>
    .product__item__pic {
        transition: linear;
    }
</style>
<!-- Product Section Begin -->
    <div class="container">
        <div class="row product__filter">
            @foreach($listproduk as $produk)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals" onclick="fnOpenProdukDetail({!! json_encode($produk['id']) !!})">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{image_url(). $produk['listImage'][0]['image_file']}}">
                    </div>
                    <div class="product__item__text">
                        <h6>{{$produk['nama']}}</h6>
                    </div>
                </div>
            </div>
             @endforeach
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
    $(function ()
    {
        $("#nav-home").addClass("active");
    });

    function fnOpenProdukDetail(id)
    {
        location.href = '/produk-detail/' + id;
    }
</script>