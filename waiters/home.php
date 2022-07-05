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
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Konfirm</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Kode Pesanan</th>
                                                <th>Meja</th>
                                                <th>Menu</th>
                                                <th>Total Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM pesanan WHERE status = 'Siap Diantar' AND DATE(tanggal) = DATE(CURDATE()) ";
                                            $sql = $koneksi->query($query);
                                            $no = 1;
                                            while ($data = $sql->fetch_assoc()) {

                                                $id_pesanan = $data['id'];
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $no ?></th>
                                                    <td><?php echo "P" . $data['id'] ?></td>
                                                    <td><?php echo $data['nomor_meja'] ?></td>
                                                    <td>
                                                        <?php
                                                        //detail produk
                                                        $query_detail = "SELECT * FROM pesanan_detail WHERE id_pesanan=$id_pesanan";
                                                        $sql_detail = $koneksi->query($query_detail);
                                                        while ($data_detail = $sql_detail->fetch_assoc()) {
                                                            echo "- ". $data_detail['jumlah'] . " " .  $data_detail['nama_menu'];
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo "RP. " . $data['total_harga'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-success mr-1 mb-1" onclick="fnAcceptButtonOnClick('<?php echo $data['id']; ?>', '<?php echo $data['nomor_meja'];?>')">Selesai</button>
                                                    </td>
                                                </tr>

                                            <?php $no = $no + 1;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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