<?php
include "../koneksi.php";
session_start();
if (isset($_SESSION['ses_username'])) {
} else {
    header("location:../login.php");
}

$totalpesanan = 0;
$sql = $koneksi->query("SELECT count(id) as totalpesanan from pesanan where DATE(tanggal) = DATE(curdate())");
while ($data = $sql->fetch_assoc()) {
    $totalpesanan = $data['totalpesanan'];
}

$pending = 0;
$sql = $koneksi->query("SELECT count(id) as pending from pesanan where DATE(tanggal) = DATE(curdate()) 
        AND status = 'Dipesan'");
while ($data = $sql->fetch_assoc()) {

    $pending = $data['pending'];
}

$siapdiapntar = 0;
$sql = $koneksi->query("SELECT count(id) as siapdiapntar from pesanan where DATE(tanggal) = DATE(curdate()) 
        AND status = 'Siap diantar'");
while ($data = $sql->fetch_assoc()) {

    $pendisiapdiapntarng = $data['siapdiapntar'];
}

$selesai = 0;
$sql = $koneksi->query("SELECT count(id) as selesai from pesanan where DATE(tanggal) = DATE(curdate()) 
        AND status = 'Selesai'");
while ($data = $sql->fetch_assoc()) {
    $selesai = $data['selesai'];
}

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<?php include "kasir_header.php"; ?>
<title>Home</title>
<!-- END: Head-->


<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- BEGIN: Navigation -->
    <?php include_once "navigation_kasir.php"; ?>
    <!-- END: Navigation -->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-users text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1"><?php echo $totalpesanan ?></h2>
                                    <p class="mb-0">Total Pesanan Hari ini</p>
                                </div>
                                <div class="card-content">
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-success p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-credit-card text-success font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1"><?php echo $pending ?></h2>
                                    <p class="mb-0">Pesanan Pending</p>
                                </div>
                                <div class="card-content">
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-shopping-cart text-danger font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1"><?php echo $siapdiapntar?></h2>
                                    <p class="mb-0">Pesanan Siap Di Antar</p>
                                </div>
                                <div class="card-content">
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-package text-warning font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1"><?php echo $selesai ?></h2>
                                    <p class="mb-0">Pesanan Selesai</p>
                                </div>
                                <div class="card-content">
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-end">
                                    <h4 class="card-title">Daftar Pesanan</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-vertical" id="frmFilter" name="frmFilter">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p><b>Status</b></p>
                                                    <fieldset class="form-group">
                                                        <select class="form-control" id="basicSelect">
                                                            <option value="">Semua</option>
                                                            <option value="Dipesan">Dipesan</option>
                                                            <option value="Sedang Diproses">Sedang Diproses</option>
                                                            <option value="Siap Diantar">Siap Diantar</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <button type="button" onclick="filter()" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->

                <!-- Zero configuration table -->
                <section id="data-thumb-view" class="data-thumb-view-header">
                    <!-- dataTable starts -->
                    <div class="table-responsive">
                        <table class="table data-thumb-view" id="tblPesanan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pesanan</th>
                                    <th>Meja</th>
                                    <th>Menu</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM pesanan WHERE status NOT IN ('Selesai', 'Ditolak') AND DATE(tanggal) = DATE(CURDATE()) ";

                                if (isset($_GET['status'])) {
                                    if ($_GET['status'] != "") {
                                        $query = $query . " AND status = '" . $_GET['status'] . "'";
                                    }
                                }
                                $sql = $koneksi->query($query);
                                $no = 1;
                                while ($data = $sql->fetch_assoc()) {

                                    $id_pesanan = $data['id'];
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td class="product-img"><?php echo "P" . $data['id'] ?></td>
                                        <td class="product-name"><?php echo $data['nomor_meja'] ?></td>
                                        <td class="product-category">
                                            <?php
                                            //detail produk
                                            $query_detail = "SELECT * FROM pesanan_detail WHERE id_pesanan=$id_pesanan";
                                            $sql_detail = $koneksi->query($query_detail);
                                            while ($data_detail = $sql_detail->fetch_assoc()) {
                                                echo $data_detail['jumlah'] . " " .  $data_detail['nama_menu'];
                                                echo "<br>";
                                            }

                                            ?>

                                        </td>
                                        <td class="product-price"><?php echo "RP. " . $data['total_harga'] ?></td>
                                        <td>
                                            <div class="chip chip-warning">
                                                <div class="chip-body">
                                                    <div class="chip-text"><?php echo $data['status']; ?></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="product-action">
                                            <?php
                                            if ($data['status'] == "Dipesan") {
                                                echo
                                                '<div class="badge badge-success mr-1 mb-1 action-edit" onclick="fnAcceptButtonOnClick(' . $data['id'] . ', \'Sedang diproses\', ' . $data['nomor_meja'] . ')">
                                                <i class="feather icon-check font-medium-5"></i>
                                            </div>
                                            <div class="badge badge-danger mr-1 mb-1 action-delete" onclick="fnRejectButtonOnClick(' . $data['id'] . ', \'Ditolak\', ' . $data['nomor_meja'] . ')">
                                                <i class="feather icon-trash font-medium-5"></i>
                                            </div>';
                                            } else if ($data['status'] == "Sedang diproses") {
                                                echo
                                                '<button type="button" class="btn btn-success mr-1 mb-1" 
                                            onclick="fnAcceptButtonOnClick(' . $data['id'] . ', \'Siap Diantar\', ' . $data['nomor_meja'] . ')">Siap Diantar</button>';
                                            } else if ($data['status'] == "Siap Diantar") {
                                                echo
                                                '<button type="button" class="btn btn-success mr-1 mb-1" 
                                            onclick="fnAcceptButtonOnClick(' . $data['id'] . ', \'Selesai\', ' . $data['nomor_meja'] . ')">Selesai</button>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- dataTable ends -->
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2019<a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent,</a>All rights Reserved</span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i class="feather icon-heart pink"></i></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->
</body>
<!-- END: Body-->

</html>

<?php include_once 'kasir_footer.php'; ?>
<script src="js/home.js?2"></script>