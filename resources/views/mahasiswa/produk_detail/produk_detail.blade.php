@extends('layouts.mahasiswa.layout')
@section('nama', getUser()['nama'])

@section('content')

<style>
    .list-stok-detail p{
        margin-bottom: 2px!important;
    }
    .list-stok-detail {
        margin-bottom: 30px;
    }
</style>

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
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
                                    <div class="product__thumb__pic set-bg" data-setbg="{{image_url(). $image['image']}}">
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
                                        <img src="{{image_url(). $image['image']}}" alt="">
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
                        <div class="product__details__text text-left">
                            <h4>{{$produk['nama']}}</h4>
                            
                            <p>{{$produk['deskripsi']}}</p>

                            <h4>Detail ukuran</h4>
                            <div class="list-stok-detail">
                                @foreach($ListStok as $stok)
                                <p>{{$stok['size']}} : {{$stok['detail']}}</p>
                                @endforeach
                            </div>

                            
                            <form action="/pesan" method="post" id="frm">
                            @csrf
                            <input type="hidden" name="id_produk" id="id_produk" value="{{$id}}">
                            <input type="hidden" name="user_id" id="user_id" value="{{getUser()['id']}}">
                            <div class="product__details__option" style="text-align: left!important;">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <br>
                                    <select style="display: block!important;" name="ddlsize" id="ddlsize" onchange="fnSizeChange()">
                                        @foreach($ListStok as $stok)
                                            <option value="{{$stok['id']}}">{{$stok['size']}} </option>
                                        @endforeach
                                    </select>
                                    
                                    <br>
                                    <br>
                                    <span style="margin-top: 30px;">Stok : <span id="lblstok">{{$ListStok[0]['stok']}}</span></span>
                                    <input type="hidden" name="txtStok" id="txtStok" value="{{$ListStok[0]['stok']}}" readonly>
                                    <br>

                                    <input type="hidden" readonly name="stok_id" id="stok_id" value="{{$ListStok[0]['id']}}">
                                    <input type="hidden" readonly name="size" id="size" value="{{$ListStok[0]['size']}}">
                                    <input type="hidden" readonly name="latest_stok" id="latest_stok" value="{{$ListStok[0]['stok'] - 1}}">
                                </div>
                            </div>

                            <div class="form-group" style="text-align: left!important;">
                                <label for="exampleFormControlTextarea1">Catatan</label>
                                <textarea class="form-control catatan" id="catatan" name="catatan" rows="3"></textarea>
                            </div>
                            <div class="product__details__cart__option"  style="text-align: right!important;">
                                <!-- <a href="#" class="primary-btn">Pesan</a> -->
                                <input type="button" name="pesan" id="pesan" value="pesan" class="primary-btn" onclick="fnValidation()"/>
                            </div>
                            </form>
                           
                        </div>
                    </div>
                </div>

                <section>
                    <form method="post" action="/komentar" onsubmit="fnSubmitKomentar()">
                    <input type="hidden" name="id_user" id="user_id_2" value="{{getUser()['id']}}">
                    <input type="hidden" name="id_produk" id="id_produk_2" value="{{$id}}">
                    @csrf
                    <div class="container my-5 py-5 text-dark">
                        <div class="row d-flex justify-content-center">
                        <div class="col-md-12 col-lg-10">
                            <div class="card">
                            <div class="card-body p-4">
                                <div class="d-flex flex-start w-100">
                                <img
                                    class="rounded-circle shadow-1-strong me-3"
                                    src="{{image_url()}}empty-user.png"
                                    alt="avatar"
                                    width="65"
                                    height="65"
                                />
                                <div class="w-100" style="margin-left: 14px;">
                                    <h5>Tulis Komentar Kamu di Sini</h5>
                                    <div class="form-outline">
                                    <textarea class="form-control" id="komentar" name="komentar" rows="4" require></textarea>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            Kirim
                                        </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </form>
                </section>

                <!-- Recent Comment -->
                <section>
                    <div class="container my-5 py-5">
                        <div class="row d-flex justify-content-center">
                        <div class="col-md-12 col-lg-10">
                            <div class="card text-dark">
                            <div class="card-body p-4">
                                <h4 class="mb-0">Komentar</h4>
                                <!-- <p class="fw-light mb-4 pb-2">Latest Comments section by users</p> -->

                                @foreach($listkomentar as $komentar)
                                <div class="d-flex flex-start" style="margin: 20px 0;">
                                <img
                                    class="rounded-circle shadow-1-strong me-3"
                                    src="{{image_url()}}empty-user.png"
                                    alt="avatar"
                                    width="60"
                                    height="60"/>
                                <div style="margin-left: 14px;">
                                    <h6 class="fw-bold mb-1" style="font-size: 12px;">{{$komentar['nama']}}</h6>
                                    <div class="d-flex align-items-center mb-3">
                                    <p class="mb-0" style="font-size: 10px;">
                                        {{date_format(new DateTime($komentar['created_date']),"d F Y")}}
                                    </p>
                                    <a href="#!" class="link-muted"></a>
                                    </div>
                                    <p class="mb-0" style="font-size: 18px;">
                                    {{$komentar['comment']}}
                                    </p>
                                </div>
                                </div>
                                <hr/>
                                @endforeach
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>
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
        $("#txtStok").val(findstok.stok);
    }

    function fnValidation(){
        if($("#txtStok").val() === "0")
        {
            alert("Tidak dapat memesan. Stok telah habis!");
            return false;
        }
        else{
            if(confirm("Apakah anda ingin memesan jas ini?"))
            {
                $("#frm").submit();
            }
        }
    }

    function fnSubmitKomentar()
    {
        if($("#komentar").val() === "")
        {
            alert("Mohon isi komentar terlebih dahulu!");
            $("#komentar").focus();
            return false;
        }
    }
</script>