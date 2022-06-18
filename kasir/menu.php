<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php include_once "kasir_header.php"; ?>
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
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">

                <!-- Zero configuration table -->
                <section id="data-thumb-view" class="data-thumb-view-header">
                    <!-- dataTable starts -->
                    <div class="table-responsive">
                        <table class="table data-thumb-view" id="tblMenu">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Menu</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                    <th class="text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="product-img"><img src="../template/app-assets/images/elements/apple-watch.png" alt="Img placeholder">
                                    </td>
                                    <td class="product-name">Cappuccino</td>
                                    <td class="product-category">Minuman</td>
                                    <td class="product-price">$69.99</td>
                                    <td class="product-action text-center">
                                        <div class="badge badge-warning mr-1 mb-1" onclick="fnEdit(this)">
                                            <i class="feather icon-edit font-medium-5"></i>
                                        </div>
                                        <div class="badge badge-danger mr-1 mb-1" onclick="fnDelete(1)">
                                            <i class="feather icon-trash font-medium-5"></i>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- dataTable ends -->

                    <div class="add-new-data-sidebar">
                        <div class="overlay-bg"></div>
                        <div class="add-new-data">
                            <form class="needs-validation" id="form" novalidate>
                                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                                    <div>
                                        <h4 class="text-uppercase">Menu Baru</h4>
                                    </div>
                                    <div class="hide-data-sidebar">
                                        <i class="feather icon-x"></i>
                                    </div>
                                </div>
                                <div class="data-items pb-3">
                                    <div class="data-fields px-2 mt-3">
                                        <div class="row">
                                            <div class="col-sm-12 data-field-col">
                                                <label for="data-name">Nama menu</label>
                                                <input type="text" class="form-control" id="newNama" name="newNama" maxlength="100" required>
                                                <div class="invalid-tooltip">
                                                    Nama tidak boleh kosong.
                                                </div>
                                            </div>
                                            <div class="col-sm-12 data-field-col">
                                                <label for="data-category"> Jenis </label>
                                                <select class="form-control" id="newJenis" required>
                                                    <option value="Makanan">Makanan</option>
                                                    <option value="Minuman">Minuman</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 data-field-col">
                                                <label for="data-status">Harga</label>
                                                <input type="text" class="form-control" id="newHarga" maxlength="10" required>
                                                <div class="invalid-tooltip">
                                                    Harga tidak boleh kosong.
                                                </div>
                                            </div>
                                            <div class="col-sm-12 data-field-col data-list-upload">
                                                <div class="dropzone dropzone-area" id="dropzone">
                                                    <div class="dz-message">Upload Image</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                                    <div class="add-data-btn">
                                        <input type="submit" name="btnSubmit" value="Add Data" class="btn btn-primary" id="btnSubmit"/>
                                    </div>
                                    <div class="cancel-data-btn">
                                        <button class="btn btn-outline-danger">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <form id="form_upload">
        <input type="file" name="file_upload" id="file_upload"/>
    </form>

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
<script src="js/menu.js"></script>