@extends('layouts.mahasiswa.layout')
@section('nama', getUser()['nama'])

@section('content')

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <h2 class="container product__details__text">Ajukan Perubahan Pemesanan</h2>
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
                        <ul class="nav nav-tabs" role="tablist" id="nav-tabs">
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
                        <div class="tab-content" id="tab-content">
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
                            <h4 id="lbl_nama_produk">{{$produk[0]['nama']}}</h4>
                            
                            <p id="lbl_deskripsi">{{$produk[0]['deskripsi']}}</p>
                            
                            <form action="/ajukan_perubahan" method="post" id="frm">
                            @csrf
                            <input type="hidden" name="id_pesanan" id="id_pesanan" value="{{$pesanan['id']}}">
                            <input type="hidden" name="id_produk_old" id="id_produk_old" value="{{$pesanan['id_produk']}}">
                            <input type="hidden" name="id_produk" id="id_produk" value="{{$pesanan['id_produk']}}">
                            <input type="hidden" name="user_id" id="user_id" value="{{getUser()['id']}}">
                            <div class="form-group"style="text-align:left!important;margin-bottom:70px!important">
                                <label>Jas Lab / Almamater</label>
                                <br>
                                <select style="display: block!important;width:100%!important" name="ddlProduk" id="ddlProduk" onchange="fnprodukchange()">
                                    @foreach($listproduk as $produk)
                                        <option value="{{$produk['id']}}" {{$produk['id'] == $pesanan['id_produk'] ? 'SELECTED' : ''}}>{{$produk['nama']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="product__details__option" style="text-align: left!important;">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <br>
                                    <select style="display: block!important;" name="ddlsize" id="ddlsize" onchange="fnSizeChange()">
                                        @foreach($ListStok as $stok)
                                            <option value="{{$stok['id']}}" {{$stok['size'] == $pesanan['size'] ? 'SELECTED' : ''}}>{{$stok['size']}}</option>
                                        @endforeach
                                    </select>
                                    
                                    <br>
                                    <br>
                                    <span style="margin-top: 30px;">Stok : <span id="lblstok">{{ $pesanan['size']}}</span></span>
                                    <input type="hidden" id="txtstok" name="txtstok" readonly/>

                                    <br>
                                    
                                    <input type="hidden" readonly name="id_stok_return" id="id_stok_return" value="{{$ListStok[0]['id']}}">
                                    <input type="hidden" readonly name="stok_id" id="stok_id" value="{{$ListStok[0]['id']}}">
                                    <input type="hidden" readonly name="size" id="size" value="{{$ListStok[0]['size']}}">
                                    <input type="hidden" readonly name="latest_stok" id="latest_stok" value="{{$ListStok[0]['stok']}}">
                                </div>
                            </div>

                            <div class="form-group" style="text-align: left!important;">
                                <label for="exampleFormControlTextarea1">Catatan</label>
                                <textarea class="form-control catatan" id="catatan" name="catatan" rows="3">{{$pesanan['catatan']}}</textarea>
                            </div>
                            <div class="product__details__cart__option"  style="text-align: right!important;">
                                <input type="button" name="pesan" id="pesan" value="Ajukan Perubahan" class="primary-btn" onclick="fnValidation()"/>
                                <input type="button" name="pesan" id="pesan" value="Kembali" class="primary-btn" onclick="javascript:location.href='/pemesanan'"/>
                            </div>
                            </form>
                           
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
<script src="{{asset('')}}client/js/jquery.nicescroll.min.js"></script>
<script src="{{asset('')}}client/js/jquery.magnific-popup.min.js"></script>
<script src="{{asset('')}}client/js/jquery.countdown.min.js"></script>
<script src="{{asset('')}}client/js/jquery.slicknav.js"></script>
<script src="{{asset('')}}client/js/mixitup.min.js"></script>
<script src="{{asset('')}}client/js/owl.carousel.min.js"></script>
<script src="{{asset('')}}client/js/main.js"></script>

<script>
    var listStok = {!! json_encode($ListStok)!!};
    var listProduk = {!! json_encode($listproduk)!!};
    var imageUrl = {!! json_encode(image_url())!!};

    $(function(){
        fnFirstPageStok();
    });


    function fnFirstPageStok()
    {
        var stok_id = $("#ddlsize").val();
        var size = $("#ddlsize option:selected").text();

        var findstok = listStok.find(x => x.id === parseInt(stok_id));

        $("#id_stok_return").val(stok_id);
        $("#stok_id").val(stok_id);
        $("#size").val(size);
        $("#lblstok").text(findstok.stok);
        $("#txtstok").val(findstok.stok);
        $("#latest_stok").val(parseInt(findstok.stok) - 1);
    }

    function fnSizeChange()
    {
        var stok_id = $("#ddlsize").val();
        var size = $("#ddlsize option:selected").text();

        var findstok = listStok.find(x => x.id === parseInt(stok_id));

        $("#stok_id").val(stok_id);
        $("#size").val(size);
        $("#latest_stok").val(findstok.stok - 1);
        $("#lblstok").text(findstok.stok);
        $("#txtstok").val(findstok.stok);

    }

    function fnprodukchange()
    {
        var id_produk = $("#ddlProduk").val();
        $("#id_produk").val(id_produk);
        var findProduk = listProduk.find(x => x.id === parseInt(id_produk));
        $("#lbl_nama_produk").text(findProduk.nama);
        $("#lbl_deskripsi").text(findProduk.deskripsi);

        //remove old data
        $("#ddlsize option").remove();
        $("#nav-tabs li").remove();
        $("#tab-content div").remove();
        

        // looping for nav tab
        var listImage = findProduk.listImage;
        for(var i = 0; i < listImage.length; i++)
        {
            image = listImage[i];
            image_file = imageUrl + image.image_file;

            var isActive = '';
            if (i === 0)
            {
                isActive = "active";
            }

            //append nav tab
            $('<li class="nav-item">\
                    <a class="nav-link '+isActive+'" data-toggle="tab" href="#tabs-'+i+'" role="tab">\
                        <div class="product__thumb__pic set-bg" style="background-image: url('+image_file.toString()+');">\
                        </div>\
                    </a>\
                </li>').appendTo("#nav-tabs");
        }

        //looping for tab content
        for(var i = 0; i < listImage.length; i++)
        {
            image = listImage[i];
            image_file = imageUrl + image.image_file;

            var isActive = '';
            if (i === 0)
            {
                isActive = "active";
            }

            //append nav tab
            $('<div class="tab-pane '+isActive+'" id="tabs-'+i.toString()+'" role="tabpanel">\
                    <div class="product__details__pic__item">\
                        <img src="'+image_file+'" alt="">\
                    </div>\
                </div>').appendTo("#tab-content ");
        }
        

        //looping for stok
        var liststokopt = findProduk.listStok;

        $.each(liststokopt, function(i, item){
            $("#ddlsize").append($('<option>', {
                value : item.id,
                text : item.size
            }));
        });

        //update data
        $("#ddlsize").niceSelect("update");
        $("#size").val(liststokopt[0].size);

        listStok = liststokopt;
    }

    function fnValidation()
    {
        if( ($("#id_stok_return").val() === $("#stok_id").val()) && ($("#id_produk_old").val() === $("#id_produk").val()))
        {
            alert("Anda belum mengubah pesanan!");
            return false;
        }
        else if($("#txtstok").val() === "0")
        {
            alert("Tidak dapat memesan produk. Stok telah habis!");
            return false;
        }
        else{
            if(confirm("Apakah anda yakin ingin mengubah pesanan?"))
            {
                $("#frm").submit();
            }
        }
    }
</script>