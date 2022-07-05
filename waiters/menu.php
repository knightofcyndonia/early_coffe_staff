<?php session_start(); ?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<?php
include_once "kasir_header.php";
include "../koneksi.php";
$nomor_meja = "";
if (isset($_GET['nomor_meja'])) {
    $nomor_meja = $_GET['nomor_meja'];
}

?>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-detached-left-sidebar ecommerce-application navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-detached-left-sidebar">
    <!-- BEGIN: Header-->
    <?php include_once "navigation_kasir.php"; ?>

    <input type="text" name="nomor_meja" id="nomor_meja" value="<?php echo $nomor_meja ?>" />
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-detached content-right">
                <div class="content-body">
                    <!-- Ecommerce Content Section Starts -->
                    <section id="ecommerce-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ecommerce-header-items">
                                    <div class="view-options">
                                        <div class="view-btn-option">
                                            <button class="btn btn-white view-btn" onclick="semua()">
                                                Semua
                                            </button>
                                            <button class="btn btn-white view-btn" onclick="makanan()">
                                                Makanan
                                            </button>
                                            <button class="btn btn-white view-btn" onclick="minuman()">
                                                Minuman
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Ecommerce Content Section Starts -->
                    <!-- background Overlay when sidebar is shown  starts-->
                    <div class="shop-content-overlay"></div>
                    <!-- background Overlay when sidebar is shown  ends-->

                    <!-- Ecommerce Search Bar Starts -->
                    <section id="ecommerce-searchbar">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <fieldset class="form-group position-relative">
                                    <input type="text" class="form-control search-product" id="iconLeft5" placeholder="Cari" onkeyup="cari(this)">
                                    <div class="form-control-position">
                                        <i class="feather icon-search"></i>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </section>
                    <!-- Ecommerce Search Bar Ends -->

                    <!-- Ecommerce Products Starts -->
                    <section id="ecommerce-products" class="grid-view">

                        <?php
                        $query = "SELECT * FROM menu;";
                        $sql = $koneksi->query($query);
                        $no = 1;
                        $url_att = "$base_url/uploads/menu";
                        while ($data = $sql->fetch_assoc()) {
                            echo "<div class='card ecommerce-card menu-card menu-" . $data['jenis'] . "'>
                                    <div class='card-content'>
                                        <div class='item-img text-center'>
                                            <a href='#'>
                                                <img class='img-fluid' src='$url_att/" . $data['id'] . "/" . $data['gambar'] . "' alt='img-placeholder'></a>
                                        </div>
                                        <div class='card-body'>
                                            <div class='item-wrapper'>
                                                <div>
                                                    <h6 class='item-price'>
                                                        Rp " . $data['harga'] . "
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class='item-name'>
                                                <a href='#'>" . $data['nama_menu'] . "</a>
                                            </div>
                                            <div>
                                                <p class='item-description'>
                                                <div class='badge badge-secondary jenis'>" . $data['jenis'] . "</div>
                                                </p>
                                            </div>
                                            
                                        </div>
                                        <div class='item-options text-center'>
                                            <div class='item-wrapper'>
                                                <div class='item-rating'>
                                                    <div class='badge badge-primary badge-md'>
                                                        <span>4</span> <i class='feather icon-star'></i>
                                                    </div>
                                                </div>
                                                <div class='item-cost'>
                                                    <h6 class='item-price'>
                                                        $39.99
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class='cart' onclick='addToCart(this, " . $data['id'] . ")'>
                                                <i class='feather icon-shopping-cart'></i> <span class='add-to-cart'>TAMBAHKAN KE PESANAN</span> 
                                                <a href='#' on class='view-in-cart d-none'>View In Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }

                        ?>
                    </section>
                    <!-- Ecommerce Products Ends -->

                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Vendor JS-->
    <script src="../template/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../template/app-assets/vendors/js/ui/prism.min.js"></script>
    <script src="../template/app-assets/vendors/js/extensions/wNumb.js"></script>
    <script src="../template/app-assets/vendors/js/extensions/nouislider.min.js"></script>
    <script src="../template/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../template/app-assets/js/core/app-menu.js"></script>
    <script src="../template/app-assets/js/core/app.js"></script>
    <script src="../template/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="../template/app-assets/js/scripts/pages/app-ecommerce-shop.js"></script> -->

    <?php include_once "kasir_footer.php"; ?>
    <script src="js/home.js?2"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>