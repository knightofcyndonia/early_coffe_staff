@extends('layouts.mahasiswa.layout')
@section('nama', getUser()['nama'])

@section('content')

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <h2 class="container product__details__text">Detail Pemesanan</h2>
        <br>
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="/home">Home</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach($listImage as $image)
                            <li class="nav-item">
                                <a class="nav-link ${{$loop->index == 0 ? 'active' : ''}}" data-toggle="tab" href="#tabs-{{$loop->index}}" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{image_url(). $image['image_file']}}">
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            @foreach($listImage as $image)
                                <div class="tab-pane {{$loop->index == 0 ? 'active' : ''}}" id="tabs-{{$loop->index}}" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="{{image_url(). $image['image_file']}}" alt="">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <input type="hidden" name="id_produk" id="id_produk" value="{{$pesanan['id_produk']}}">
                            <input type="hidden" name="user_id" id="user_id" value="{{getUser()['id']}}">
                            <div class="product__details__option" style="text-align: left!important;">
                                <div class="product__details__option__size">
                                    <p>Nama Pemesan : {{$user['nama']}}</p>
                                    <p>Jurusan/Prodi : {{$user['jurusan']}}/{{$user['prodi']}}</p>
                                    <p>Tanggal pesan : {{date_format(new DateTime($pesanan['created_at']),"d F Y")}}</p>
                                    <p>Produk : {{$produk[0]['nama']}}</p>
                                    <p>Size: {{$pesanan['size']}}</p>
                                    <p>Status : {{$pesanan['status']}}</p>

                                    <br>

                                    <input type="hidden" readonly name="stok_id" id="stok_id" value="{{$ListStok[0]['id']}}">
                                    <input type="hidden" readonly name="size" id="size" value="{{$ListStok[0]['size']}}">
                                    <input type="hidden" readonly name="latest_stok" id="latest_stok" value="{{$ListStok[0]['stok']}}">
                                </div>
                            </div>

                            <div class="form-group" style="text-align: left!important;">
                                <label for="exampleFormControlTextarea1">Catatan</label>
                                <textarea class="form-control catatan" id="catatan" name="catatan" rows="3" readonly></textarea>
                            </div>

                            
                            <div class="product__details__cart__option"  style="text-align: right!important;">
                                <input type="submit" name="kembali" id="kembali" value="Kembali" class="primary-btn" onclick="location.href = '/pemesanan'"/>
                            </div>
                           
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->
    
    <section class="related spad"></section>
    @endsection


    
<!-- Js Plugins -->
<script src="{{asset('')}}client/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('')}}client/js/bootstrap.min.js"></script>
<!-- <script src="{{asset('')}}client/js/jquery.nice-select.min.js"></script> -->
<script src="{{asset('')}}client/js/jquery.nicescroll.min.js"></script>
<script src="{{asset('')}}client/js/jquery.magnific-popup.min.js"></script>
<script src="{{asset('')}}client/js/jquery.countdown.min.js"></script>
<script src="{{asset('')}}client/js/jquery.slicknav.js"></script>
<script src="{{asset('')}}client/js/mixitup.min.js"></script>
<script src="{{asset('')}}client/js/owl.carousel.min.js"></script>
<script src="{{asset('')}}client/js/main.js"></script>

<script>
    var listStok = {!! json_encode($ListStok)!!};
    $(function(){
    });

    function fnSizeChange()
    {
        var stok_id = $("#ddlsize").val();
        var size = $("#ddlsize option:selected").text();

        var findstok = listStok.find(x => x.id === parseInt(stok_id));

        $("#stok_id").val(stok_id);
        $("#size").val(size);
        $("#latest_stok").val(findstok.stok - 1);
        $("#lblstok").text(findstok.stok);

    }
</script>