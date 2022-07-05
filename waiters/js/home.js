$(document).ready(function () {});

function semua() {
  $(".menu-card").show();
}

function makanan() {
  $(".menu-Makanan").show();
  $(".menu-Minuman").hide();
}

function minuman() {
  $(".menu-Makanan").hide();
  $(".menu-Minuman").show();
}

function cari(object) {
  var filter = object.value;

  if (filter !== "") {
    $(".item-name a").each(function () {
      if ($(this).text().toLowerCase().includes(filter.toLowerCase())) {
        $(this).parent().parent().parent().show();
      } else {
        $(this).parent().parent().parent().hide();
        $(this).parent().parent().siblings(".card-content").css("display", "block");
      }
    });
  } else {
    $(".menu-card").show();
    $(".menu-card .card-content").css("display", "block");
  }

}

function addToCart(object, id_menu) {
  var nomor_meja = $("#nomor_meja").val();

  var is_cart = $($(object).find('.add-to-cart')).is(":visible");

  if (is_cart) {
    $.ajax({
      type: "POST",
      url: "pesanan-controller.php",
      data: {
        nomor_meja: nomor_meja,
        type: "masuk keranjang",
        id_menu: id_menu
      },
      success: function (res) {
        if (res.includes("Gagal")) {
          Swal.fire({
            title: "Gagal!",
            text: res,
            type: "error",
            confirmButtonClass: 'btn btn-primary',
            buttonsStyling: false,
          }).then((result) => {
            if (result.value) {
              // window.location = 'home.php?nomor_meja=' + nomor_meja;
            }
          });
        } else {
          Swal.fire({
            title: "Berhasil!",
            text: res,
            type: "success",
            confirmButtonClass: 'btn btn-primary',
            buttonsStyling: false,
          }).then((result) => {
            // if (result.value) {
            // window.location = 'home.php?nomor_meja=' + nomor_meja;   
            // }

            var $this = $(object),
              addToCart = $this.find(".add-to-cart"),
              viewInCart = $this.find(".view-in-cart");
            if (addToCart.is(':visible')) {
              addToCart.addClass("d-none");
              viewInCart.addClass("d-inline-block");
            } else {
              var href = viewInCart.attr('href');
              window.location.href = href;
            }
          });
        }

      }
    })
  } else {
    window.location.href = "keranjang.php?nomor_meja=" + nomor_meja;
  }
}

function fnAcceptButtonOnClick(idPesanan, nomor_meja) {
  Swal.fire({
    title: 'Konfirmasi Pesanan?',
    text: "Apakah anda yakin ingin menyetujui pesanan?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#28c76f',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Setuju!',
    cancelButtonText: 'Tidak!',
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-outline-danger ml-1',
    buttonsStyling: false,
  }).then(function (result) {
    if (result.value) {

      $.ajax({
        type: "POST",
        url: "pesanan-controller.php",
        data: {
          id_pesanan: idPesanan,
          status: "Selesai",
          nomor_meja: nomor_meja,
          type: "ganti status pesanan"
        },
        success: function (res) {
          if (res.includes("Gagal")) {
            Swal.fire({
              title: "Gagal!",
              text: res,
              type: "error",
              confirmButtonClass: 'btn btn-primary',
              buttonsStyling: false,
            }).then((result) => {
              if (result.value) {
                window.location = 'menu.php?';
              }
            });
          } else {
            Swal.fire({
              type: "success",
              title: 'Berhasil!',
              text: res,
              confirmButtonClass: 'btn btn-success',
            }).then((result) => {
              window.location = "home.php"
            });
          }
        }
      });
    }
  })
}