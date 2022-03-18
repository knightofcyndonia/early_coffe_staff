<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="PEMESANAN JAS POLTEK">
    <meta name="keywords" content="PEMESANAN JAS POLTEK, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="{{asset('')}}image/logo.png">
    <title>PEMESANAN JAS POLTEK</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('')}}assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('')}}client/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('')}}client/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('')}}client/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset('')}}client/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{asset('')}}client/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{asset('')}}client/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('')}}client/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('')}}client/css/style.css" type="text/css">
</head>

<style>
    .dropdown-item{
        white-space: unset;
    }
    .link {
        color: #cac6e0;
        transition: 0.3s linear;
        margin:  0 5px;
    }
    .link:hover{
        color:#fff;
    }
    .notif_date{
        font-size: 14px;
    }
    .dropdown-header{
        padding:none;
    }
    .dropdown-menu hr{
        margin-top: 0rem!important;
        margin-bottom: 0rem!important;
    }
    .dropdown-menu{
        width: 400px;
        min-width:400px;
        /* display:block!important; */
        top:50px;
        word-wrap: break-word!important;
    }
</style>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <input type="hidden" name="id_user" id="id_user" value="{{getUser()['id']}}" readonly>
    <input type="hidden" name="apiUrl" id="apiUrl" value="{{apiUrl()}}" readonly>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__nav__option">
            <a href="#" style="color:black">@yield('nama')</a> 
            <br>
            <a href="#" style="color:black" role="button">
                <i class="far fa-bell"></i>
                @if($totalNotifikasi != 0 || $totalNotifikasi != null)
                    <span class="badge badge-warning navbar-badge">{{$totalNotifikasi}}</span>
                @endif
            </a>
            <a href="javascript:window.open('https://api.whatsapp.com/send?phone=628');" style="color:black" role="button"><i class="far fa-comments"></i></a>
            <a href="#" style="color:black" role="button" onclick="fnLogout()"><i class="fas fa-sign-out-alt"></i></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <!-- <p>Free shipping, 30-day return or refund guarantee.</p> -->
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div style="width: 90%;margin : 0 auto;">
            <div class="row">
                <div class="col-lg-3 col-md-3" id="header-logo">
                    <div class="header__logo">
                        <a href="/home"><img src="{{asset('')}}image/logo.png" alt="" width="60" height="60"></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4" id="header-nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li id="nav-home"><a href="/home">Home</a></li>
                            <!-- <li id="nav-jurusan"><a href="#">Jurusan</a>
                                <ul class="dropdown">
                                    <li><a href="#">About Us</a></li>
                                    <li><a href=".#">Shop Details</a></li>
                                    <li><a href="#">Shopping Cart</a></li>
                                    <li><a href="#">Check Out</a></li>
                                    <li><a href="#">Blog Details</a></li>
                                </ul>
                            </li> -->
                            <li id="cetak"><a href="/pemesanan">Pemesanan</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="header__nav__option">
                        <a href="#" style="color:black">@yield('nama')</a> 
                        <a href="#" style="color:black" role="button" class="notif-logo" onclick="fnNotifClick()">
                            <i class="far fa-bell"></i>
                            @if($totalNotifikasi != 0 || $totalNotifikasi != null)
                            <span class="badge badge-warning navbar-badge">{{$totalNotifikasi}}</span>
                            @endif
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                    <p class="dropdown-item dropdown-header">{{$totalNotifikasi}} Notifikasi</p>
                                    <hr>

                                    @foreach($listNotifikasi as $notifikasi)
                                    <a href="#" class="dropdown-item" style="width: 100%;">
                                        <i class="far fa-bell mr-2"></i>
                                        @if($notifikasi['status_pesanan'] == 'Diterima')
                                            Pihak Koperasi Telah Menerima Pesanan {{$notifikasi['nama']}} anda
                                        @elseif($notifikasi['status_pesanan'] == 'Ditolak')
                                            Pihak Koperasi Telah Menolak Pesanan {{$notifikasi['nama']}} anda
                                        @endif
                                        <p class="notif_date">{{date_format(new DateTime($notifikasi['created_date']),"d F Y")}}</p>
                                    </a>
                                    @endforeach
                                    <a href="/notifikasi" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
                                </div>
                        <a href="javascript:window.open('https://api.whatsapp.com/send?phone=628');" style="color:black" role="button"><i class="far fa-comments"></i></a>
                        <a href="#" style="color:black" role="button" onclick="fnLogout()"><i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->
    <section>
        @yield('content')
    </section>

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="{{asset('')}}client/img/footer-logo.png" alt=""></a>
                        </div>
                        <p>Alamat</p>
                        <p>Jl. Ahmad Yani Batam Kota. Kota Batam. kepulauan Riau. Indonesia</p>
                        <p>Phone : +62-778-469858 Ext.1017</p>
                        <p>Fax : +62-778-463620</p>
                        <p>Email : info@polibatam.ac.id</p>
                        <!-- <a href="#"><img src="{{asset('')}}client/img/payment.png" alt=""></a> -->
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Quick Link</h6>
                        <ul>
                            <li><a href="#">Perpustakaan</a></li>
                            <li><a href="#">Jurnal</a></li>
                            <li><a href="#">Repository</a></li>
                            <li><a href="#">Penelitian</a></li>
                            <li><a href="#">Penjaminan Mutu</a></li>
                            <li><a href="#">Beasiswa</a></li>
                            <li><a href="#">Kemahasiswaan</a></li>
                            <li><a href="#">Helpdesk</a></li>
                            <li><a href="#">Ikatan Alumni Polibatam</a></li>
                            <li><a href="#">Lembaga Sertifikasi Profesi</a></li>
                            <li><a href="#">Layanan Aspirasi dan Pengaduan Online Rakyat (LAPOR)</a></li>
                            <li><a href="#">Kemendikbud RI</a></li>
                            <li><a href="#">Dirjen Pendidikan Vokasi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>E-Learning</h6>
                        <ul>
                            <li><a href="#">E-Learning Jurusan Teknik Mesin</a></li>
                            <li><a href="#">E-Learning Jurusan Teknik Elektronika</a></li>
                            <li><a href="#">E-Learning Jurusan Teknik Informatika</a></li>
                            <li><a href="#">E-Learning Jurusan Manajemen Bisnis</a></li>
                        </ul>
                        
                        <br>
                        <h6>Akademik</h6>
                        <ul>
                            <li><a href="#">Pendaftaran Online</a></li>
                            <li><a href="#">Sistem Informasi Akademik</a></li>
                            <li><a href="#">Pelayanan Mahasiswa</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Follow kami di</h6>
                        <div class="footer__newslatter">
                        <a href="https://www.instagram.com/polibatamofficial/" class="link"><i class="fab fa-2x fa-instagram"></i></a>
                        <a href="https://www.facebook.com/PolibatamOfficial/" class="link"><i class="fab fa-2x fa-facebook"></i></a>
                        <a href="https://twitter.com/polibatam_" class="link"><i class="fab fa-2x fa-twitter"></i></a>
                        <a href="https://www.youtube.com/channel/UCxKsDnDYt30bMdXyakD_ZCw" class="link"><i class="fab fa-2x fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <!-- <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>2020
                            All rights reserved | This template is made with <i class="fa fa-heart-o"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </p> -->
                        <p>Copyright ©2020
                            All rights reserved
                        </p>

                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

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
</body>


<script>

    $(function(){
        $("section, #header-logo, #header-nav, footer, .header__nav__option a:not(.notif-logo)").click(function(){
            $(".dropdown-menu").slideUp(200);
        });
    })
    
    function fnLogout()
    {
        if (confirm('Apakah anda yakin ingin keluar?')) {
        // Save it!
        location = "{{URL::to('logout')}}";
        }
    }

    function fnNotifClick()
    {
        $(".dropdown-menu").slideDown(200);
        var userid = $("#id_user").val();

        var apiUrl = $("#apiUrl").val();

        $.ajax({
            type: "POST",
            url: apiUrl + "/updateNotif",
            data : {
            'tipe_notif': "STATUS_KOPERASI",
            'id_user' : userid
            },
            success: function(response){
                $(".navbar-badge").remove();
            }
        });
    }
</script>

</html>