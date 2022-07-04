$(document).ready(function () {

    fnDataTableCustomWithExport("table");
    $('#txtDateFrom, #txtDateTo').pickadate();
});


function fnAcceptButtonOnClick() {
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
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            Swal.fire({
                type: "success",
                title: 'Deleted!',
                text: 'Your file has been deleted.',
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
                title: 'Deleted!',
                text: 'Your file has been deleted.',
                confirmButtonClass: 'btn btn-success',
            })
        }
    })
}