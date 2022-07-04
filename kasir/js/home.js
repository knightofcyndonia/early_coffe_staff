$(document).ready(function () {
  fnDataTableCustom("tblPesanan");
});


function fnAcceptButtonOnClick(idMenu) {
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
      Swal.fire({
        type: "success",
        title: 'Berhasil!',
        text: 'Konfirmasi Berhasil.',
        confirmButtonClass: 'btn btn-success',
      })
    }
  })
}

function fnRejectButtonOnClick() {
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
      Swal.fire({
        type: "success",
        title: 'Berhasil!',
        text: 'Pesanan telah dibatalkan',
        confirmButtonClass: 'btn btn-success',
      })
    }
  })
}