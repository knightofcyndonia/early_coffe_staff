$(document).ready(function () {
  fnDataTableCustom("tblPesanan");
});


function fnAcceptButtonOnClick(idPesanan, status, nomor_meja) {
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
          status: status,
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
            }).then((result) =>{
              window.location = "home.php"
            });
          }
        }
      });


    }
  })
}

function fnRejectButtonOnClick(idPesanan, status, nomor_meja) {
  Swal.fire({
    title: 'Tolak Pesanan?',
    text: "Apakah anda yakin ingin menolak pesanan?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#28c76f',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Setuju!',
    cancelButtonText: 'Tidak!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-warning ml-1',
    buttonsStyling: false,
  }).then(function (result) {
    if (result.value) {
      if (result.value) {

        $.ajax({
          type: "POST",
          url: "pesanan-controller.php",
          data: {
            id_pesanan: idPesanan,
            status: status,
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
              }).then((result) =>{
                window.location = "home.php"
              });
            }
          }
        });
      }
    }
  })
}

function filter(){
  var status = $("#basicSelect").val();
  if(status !== ""){
    location.href = "home.php?status=" + status;
  }else{
    location.href = "home.php";
  }
}