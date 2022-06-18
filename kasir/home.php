<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<?php include_once "kasir_header.php"; ?>
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
                                    <h2 class="text-bold-700 mt-1">92.6k</h2>
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
                                    <h2 class="text-bold-700 mt-1">97.5k</h2>
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
                                    <h2 class="text-bold-700 mt-1">36%</h2>
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
                                    <h2 class="text-bold-700 mt-1">97.5K</h2>
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
                                                            <option>IT</option>
                                                            <option>Blade Runner</option>
                                                            <option>Thor Ragnarok</option>
                                                        </select>
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
                                <tr>
                                    <td></td>
                                    <td class="product-img"><img src="../template/app-assets/images/elements/apple-watch.png" alt="Img placeholder">
                                    </td>
                                    <td class="product-name">Apple Watch series 4 GPS</td>
                                    <td class="product-category">Computers</td>
                                    <td class="product-price">$69.99</td>
                                    <td>
                                        <div class="chip chip-warning">
                                            <div class="chip-body">
                                                <div class="chip-text">Dipesan</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-action">
                                        <div class="badge badge-success mr-1 mb-1 action-edit" onclick="fnAcceptButtonOnClick()">
                                            <i class="feather icon-check font-medium-5"></i>
                                        </div>
                                        <div class="badge badge-danger mr-1 mb-1 action-delete" onclick="fnRejectButtonOnClick()">
                                            <i class="feather icon-trash font-medium-5"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="product-img"><img src="../template/app-assets/images/elements/apple-watch.png" alt="Img placeholder">
                                    </td>
                                    <td class="product-name">Apple Watch series 4 GPS</td>
                                    <td class="product-category">Computers</td>
                                    <td class="product-price">$69.99</td>
                                    <td>
                                        <div class="chip chip-warning">
                                            <div class="chip-body">
                                                <div class="chip-text">Sedang diproses</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-action">
                                        <button type="button" class="btn btn-success mr-1 mb-1" onclick="fnAcceptButtonOnClick()">Siap Diantar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="product-img"><img src="../template/app-assets/images/elements/apple-watch.png" alt="Img placeholder">
                                    </td>
                                    <td class="product-name">Apple Watch series 4 GPS</td>
                                    <td class="product-category">Computers</td>
                                    <td class="product-price">$69.99</td>
                                    <td>
                                        <div class="chip chip-warning">
                                            <div class="chip-body">
                                                <div class="chip-text">Siap Diantar</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-action">
                                        <button type="button" onclick="fnAcceptButtonOnClick()" class="btn btn-success mr-1 mb-1">Selesai</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="product-img"><img src="../template/app-assets/images/elements/apple-watch.png" alt="Img placeholder">
                                    </td>
                                    <td class="product-name">Apple Watch series 4 GPS</td>
                                    <td class="product-category">Computers</td>
                                    <td class="product-price">$69.99</td>
                                    <td>
                                        <div class="chip chip-success">
                                            <div class="chip-body">
                                                <div class="chip-text">Selesai</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-action">
                                    </td>
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

<?php include_once 'kasir_footer.php';?>
<script src="js/home.js?2"></script>