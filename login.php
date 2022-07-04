<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">


<?php
include_once("header.php");
?>

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="template/app-assets/images/pages/login.png" alt="branding logo">
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Login</h4>
                                            </div>
                                        </div>
                                        <p class="px-2">Welcome back, please login to your account.</p>
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                <form method="post" action="">
                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input type="text" name="username" class="form-control" id="user-name" placeholder="Username" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="user-name">Username</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group position-relative has-icon-left">
                                                        <input type="password" name="password" class="form-control" id="user-password" placeholder="Password" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">Password</label>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <select class="form-control" id="ddlRole" name="ddlRole">
                                                            <option value="Kasir">Kasir</option>
                                                            <option value="Waiters">Waiters</option>
                                                        </select>
                                                    </fieldset>

                                                    <button type="submit" name="btnLogin" class="btn btn-primary btn-block">Login</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="login-footer">
                                            <div class="divider">
                                            </div>
                                            <div class="footer-btn d-inline">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

</body>
<!-- END: Body-->

</html>

<?php

if (isset($_POST['btnLogin'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $sql_login = "SELECT * FROM user WHERE BINARY username='$username' AND password='$password'";
    $query_login = mysqli_query($koneksi, $sql_login);
    $data_login = mysqli_fetch_array($query_login, MYSQLI_BOTH);
    $jumlah_login = mysqli_num_rows($query_login);


    if ($jumlah_login == 1) {
        $_SESSION["ses_id"] = $data_login["id"];
        $_SESSION["ses_nama"] = $data_login["nama"];
        $_SESSION["ses_username"] = $data_login["username"];
        $_SESSION["ses_username"] = "admin";

        // echo "<script>window.location = 'kasir/home.php'</script>";

        echo "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Login Berhasil!',
            type: 'success',
            confirmButtonClass: 'btn btn-primary',
            buttonsStyling: false,
          }).then((result) => {
                    window.location = 'kasir/home.php';
            })</script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Login Gagal!',
            text: ' Username atau Password Salah!',
            type: 'error',
            confirmButtonClass: 'btn btn-primary',
            buttonsStyling: false,
          });</script>";
    }
}
