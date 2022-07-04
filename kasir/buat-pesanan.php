<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php
include_once "kasir_header.php";
include "../koneksi.php";

//tampilin list menu untuk drop down list
$query = "SELECT * FROM menu;";
$sql = $koneksi->query($query);
$listMenu = [];
while ($data = $sql->fetch_assoc()) {
    array_push($listMenu,  $data);
}

$list = json_encode($listMenu);
echo "<script>var listMenu = $list</script>";
?>
<title>Menu</title>

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->

    <!-- END: Header-->

    <!-- BEGIN: Navigation -->
    <?php include_once "navigation_kasir.php"; ?>
    <!-- END: Navigation -->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>

        <form id="frm">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <!-- Dashboard Ecommerce Starts -->
                    <section id="dashboard-ecommerce">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-end">
                                        <h4 class="card-title">Buat Pesanan</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Nomor Meja</b></p>
                                                    <fieldset class="form-group">
                                                        <input type='text' class="form-control" id="txtNomorMeja" 
                                                        onkeypress="return isNumberKey(event, this)" 
                                                        onchange="getPesananByNomorMeja()"name="txtNomorMeja" maxlength="10"/>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <p><b>Nama</b></p>
                                                    <fieldset class="form-group">
                                                        <input type='text' class="form-control" id="txtNama" name="txtNama" maxlength="100"/>
                                                    </fieldset>
                                                </div>
                                            </div>
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
                            <button class="btn btn-outline-primary" type="button" onclick="tambahPesanan()"><i class='feather icon-plus' ></i> Tambah Pesanan</button>
                            <table class="table data-thumb-view" id="tblPesan">
                                <thead>
                                    <tr>
                                        <th>Nama Menu</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyNew">
                                </tbody>
                                <tbody id="tbodyPrev">
                                </tbody>
                            </table>

                            <button type="button" class="btn btn-primary" onclick="pesan()">Pesan</button>
                        </div>
                        <!-- dataTable ends -->

                    </section>

                </div>
            </div>
        </form>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <!-- <form id="form_upload">
        <input type="file" name="file_upload" id="file_upload" />
    </form> -->

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
<script src="js/buat-pesanan.js?2"></script>