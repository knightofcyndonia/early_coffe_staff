<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="" id="home" href="home.php"><i class="ficon feather icon-home"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto">
                            <span>Early Coffe Shop</span>
                        </li>

                    </ul>

                    <ul class="nav navbar-nav bookmark-icons">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="home.php" data-toggle="tooltip" data-placement="top" title="Home">Home</a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="menu.php" data-toggle="tooltip" data-placement="top" title="Menu">Menu</a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="laporan-pemesanan.php" data-toggle="tooltip" data-placement="top" title="Laporan Pesanan">Laporan pesanan</i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search" id="keranjang" href="keranjang.php"><i class="ficon feather icon-file-text"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->

<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="../template/html/ltr/vertical-menu-template/index.html">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Vuexy</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item" id="nav-item-home"><a href="home.php"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Home</span></a>
            </li>
            </li>
            <li class=" nav-item" id="nav-item-menu"><a href="menu.php"><i class="feather icon-clipboard"></i><span class="menu-title" data-i18n="Menu">Menu</span></a>
            </li>
            <li class=" nav-item" id="nav-item-laporan-pemesanan"><a href="laporan-pemesanan.php"><i class="feather icon-bar-chart"></i><span class="menu-title" data-i18n="Laporan Pesanan">Laporan Pesanan</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

<script>
    $(document).ready(function() {
        setActiveNavBar();
    });

    function setActiveNavBar() {
        var pathfile = window.location.pathname;
        var currentPage = pathfile.split("/")[3];
        if (currentPage !== null) {
            currentPage = currentPage.replace(".php", "");
            $("#nav-item-" + currentPage).addClass("active");
        }
    }
</script>