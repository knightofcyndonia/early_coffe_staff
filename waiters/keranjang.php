<?php session_start(); ?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<?php
include_once "kasir_header.php";
include "../koneksi.php";
$nomor_meja = "0";

if (isset($_GET['nomor_meja'])) {
    $nomor_meja = $_GET['nomor_meja'];
}
?>

<style>
    .product-img img {
        max-width: 100px;
        max-height: 100px;
        padding: 10px;
    }

    .product-name {
        text-align: center;
        font-weight: 600;
    }

    .price {
        font-family: inherit;
        font-weight: 500;
        color: #2c2c2c;
        font-size: 12px;
    }
</style>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-detached-left-sidebar ecommerce-application navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-detached-left-sidebar">
    <!-- BEGIN: Header-->
    <?php include_once "navigation_kasir.php"; ?>

    <form class="form-horizontal" novalidate id="frm">
        <input type="text" name="nomor_meja" id="nomor_meja" value="<?php echo $nomor_meja ?>" />
        <!-- END: Header-->

        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-detached content-right">
                    <div class="content-body">
                        <section>
                            <?php

                            $nama = "";
                            $readonly = "";
                            $status = "Belum Pesan";
                            //cek query pesanan.
                            $sql_cek = "SELECT * FROM pesanan where nomor_meja = '$nomor_meja' AND status NOT IN ('selesai' ,'ditolak') AND date(tanggal) = DATE(CURDATE()) ORDER BY ID DESC LIMIT 1";
                            $query_cek = mysqli_query($koneksi, $sql_cek);
                            $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
                            $jumlah_pesanan = mysqli_num_rows($query_cek);

                            if ($jumlah_pesanan > 0) {
                                $nama = $data_cek['nama_pelanggan'];
                                $status = $data_cek['status'];
                                $readonly = "readonly";
                            }

                            echo '<div class="row">
                                <div class="col-7">
                                    <h5 class="text-bold">
                                    <input type="text" class="form-control" 
                                        id="txtNomorMeja" onkeypress="return isNumberKey(event, this)" maxlength="10" placeholder="Nomor Meja"/>
                                    </h5>
                                </div>
                                <div class="col">
                                    <h6>Status : ' . $status . '</h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <!-- <fieldset class="form-group position-relative"> -->
                                    <div class="form-group">
                                        <div class="controls">
                                            <input ' . $readonly . ' type="text" value="' . $nama . '" id="txtNama" name="nama" class="form-control" id="basicInput" placeholder="Nama" maxlength="100" required data-validation-required-message="Masukkan nama">
                                        </div>
                                    </div>

                                    <div id="alert-nama" class="alert alert-danger mt-1 alert-validation-msg" role="alert" style="display: none;">
                                        <i class="feather icon-info mr-1 align-middle"></i>
                                        <span>Mohon masukkan nama</span>
                                    </div>
                                    <!-- </fieldset> -->
                                </div>

                            </div>';

                            ?>
                        </section>

                        <!-- Ecommerce Products Starts -->
                        <section id="ecommerce-products" class="grid-view">
                            <?php
                            $query = "SELECT a.id, a.nomor_meja, a.id_menu, a.status, b.nama_menu, b.jenis, b.harga, b.gambar 
                                        FROM keranjang a 
                                        INNER JOIN menu b ON a.id_menu = b.id 
                                        WHERE nomor_meja = '$nomor_meja' AND date(created_date) = DATE(CURDATE()) AND a.status NOT IN ('selesai' , 'Ditolak')
                                        ORDER BY a.status ASC;";
                            $sql = $koneksi->query($query);
                            $no = 1;
                            $url_att = "$base_url/uploads/menu";
                            while ($data = $sql->fetch_assoc()) {

                                if ($data['status'] == "Dipesan") {
                                    echo
                                    "<div class='card card-item-menu'>
                                        <div class='row'>
                                            <div class='col product-img'>
                                                <img src='$url_att/" . $data['id_menu'] . "/" . $data['gambar'] . "' alt='Img placeholder'>
                                            </div>
                                            <div class='col'>
                                                <div style='margin-top:25px;'>
                                                    <span class='product-name'>" . $data['nama_menu'] . "</span>
                                                    <br>
                                                    <span class='price'>RP " . $data['harga'] . "</span>
                                                </div>
                                                <div class=''>
                                                    <input type='hidden' class='txtIdKeranjang' name='txtIdKeranjang[]' value='" . $data['id'] . "'/>
                                                    <input type='hidden'class='txtIdMenu' name='txtIdMenu[]' value='" . $data['id_menu'] . "'/> 
                                                    <input type='hidden' class='txtNamaMenu' name='txtNamaMenu[]' value='" . $data['nama_menu'] . "'/> 
                                                    <input type='hidden' class='txtHarga' name='txtHarga[]' value='" . $data['harga'] . "'/> 
                                                </div>
                                            </div>
                                            <div class='col' style='margin-top:25px'>
                                                <div class='input-group' style='width: 90%'>
                                                    <input type='number' readonly class='touchspin form-control txtJumlah' value='1' name='jumlah[]'>
                                                </div>
                                                <div style='width: 90%;margin-top:5px; margin-bottom:10px; text-align:center'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                                } else {
                                    echo
                                    "<div class='card card-item-menu card-item-belum-dipesan'>
                                        <div class='row'>
                                            <div class='col product-img'>
                                                <img src='$url_att/" . $data['id_menu'] . "/" . $data['gambar'] . "' alt='Img placeholder'>
                                            </div>
                                            <div class='col'>
                                                <div style='margin-top:25px;'>
                                                    <span class='product-name'>" . $data['nama_menu'] . "</span>
                                                    <br>
                                                    <span class='price'>RP " . $data['harga'] . "</span>
                                                </div>
                                                <div class=''>
                                                    <input type='hidden' class='txtIdKeranjang' name='txtIdKeranjang[]' value='" . $data['id'] . "'/>
                                                    <input type='hidden'class='txtIdMenu' name='txtIdMenu[]' value='" . $data['id_menu'] . "'/> 
                                                    <input type='hidden' class='txtNamaMenu' name='txtNamaMenu[]' value='" . $data['nama_menu'] . "'/> 
                                                    <input type='hidden' class='txtHarga' name='txtHarga[]' value='" . $data['harga'] . "'/> 
                                                </div>
                                            </div>
                                            <div class='col' style='margin-top:25px'>
                                                <div class='input-group' style='width: 90%'>
                                                    <input type='number' class='touchspin form-control txtJumlah' value='1' name='jumlah[]'>
                                                </div>
                                                <div style='width: 90%;margin-top:5px; margin-bottom:10px; text-align:center'>
                                                    <button type='button' class='btn btn-block btn-sm btn-danger waves-effect waves-light' onclick='removeItem(this)'>
                                                        <div class='fonticon-wrap'><i class='fa fa-trash-o'></i></div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                                }
                            }
                            ?>
                        </section>
                        <!-- Ecommerce Products Ends -->

                        <section id="section-total">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                Total
                                            </div>
                                            <div class="col">
                                                <span id="totalHarga"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" id="div-pesan">
                                        <button type="button" id="btnSubmit" class="btn mb-1 btn-primary btn-md btn-block waves-effect waves-light">Pesan Sekarang</button>
                                        <br>
                                        * Pastikan pesanan sudah benar. Pesanan tidak dapat diubah
                                    </div>

                                </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </form>
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
    <script src="../template/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../template/app-assets/js/core/app-menu.js"></script>
    <script src="../template/app-assets/js/core/app.js"></script>
    <script src="../template/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="../template/app-assets/js/scripts/pages/app-ecommerce-shop.js"></script> -->

    <?php include_once "kasir_footer.php"; ?>
    <script src="js/keranjang.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>