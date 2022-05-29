<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Dashboard ecommerce - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="../template/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../template/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../template/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/pages/card-analytics.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="../template/app-assets/css/pages/data-list-view.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../template/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->

    <!-- END: Header-->

    <!-- BEGIN: Navigation -->
    <?php include_once "navigation_kasir.php"; ?>
    <!-- END: Navigation -->

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
                <li class="active nav-item"><a href="home.php"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Home</span></a>
                </li>
                </li>
                <li class=" nav-item"><a href="app-email.html"><i class="feather icon-clipboard"></i><span class="menu-title" data-i18n="Menu">Menu</span></a>
                </li>
                <li class=" nav-item"><a href="app-chat.html"><i class="feather icon-bar-chart"></i><span class="menu-title" data-i18n="Laporan Pesanan">Laporan Pesanan</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

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
                                    <div id="line-area-chart-1"></div>
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
                                    <div id="line-area-chart-2"></div>
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
                                    <div id="line-area-chart-3"></div>
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
                                    <div id="line-area-chart-4"></div>
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
                                        <div class="badge badge-success mr-1 mb-1">
                                            <i class="feather icon-check font-medium-5"></i>
                                        </div>
                                        <div class="badge badge-danger mr-1 mb-1">
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
                                        <button type="button" class="btn btn-success mr-1 mb-1">Siap Diantar</button>
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
                                        <button type="button" class="btn btn-success mr-1 mb-1">Selesai</button>
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


    <!-- BEGIN: Vendor JS-->
    <script src="../template/app-assets/vendors/js/vendors.min.js"></script>
    <script src="../template/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="../template/app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="../template/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../template/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../template/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="../template/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="../template/app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <script src="../template/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../template/app-assets/js/core/app-menu.js"></script>
    <script src="../template/app-assets/js/core/app.js"></script>
    <script src="../template/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../template/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <!-- <script src="../template/app-assets/js/scripts/ui/data-list-view.js"></script> -->
    <script src="js/home.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>