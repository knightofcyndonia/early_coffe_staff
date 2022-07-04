<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php include_once "kasir_header.php"; ?>
<title>Laporan Pemesanan</title>

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
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-end">
                                    <h4 class="card-title">Daftar Pesanan</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-vertical" id="frmFilter" name="frmFilter">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Tanggal Dari</b></p>
                                                    <fieldset class="form-group">
                                                        <input type='text' class="form-control" id="txtDateFrom" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <p><b>Tanggal Sampai</b></p>
                                                    <fieldset class="form-group">
                                                        <input type='text' class="form-control" id="txtDateTo" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
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
                <section class="column-selectors">
                    <!-- dataTable starts -->
                    <div class="table-responsive">
                        <table class="table table-striped dataex-html5-selectors" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pesanan</th>
                                    <th>Meja</th>
                                    <th>Menu</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="">A331
                                    </td>
                                    <td class="product-name">Apple Watch series 4 GPS</td>
                                    <td class="product-category">Computers</td>
                                    <td class="product-price">$69.99</td>
                                </tr>
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
<script src="js/laporan-pemesanan.js?2"></script>