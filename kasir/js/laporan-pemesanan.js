$(document).ready(function () {

    fnDataTableCustom("table");
    $('#txtDateFrom, #txtDateTo').pickadate({
        format: 'dd/mm/yyyy',
        selectYears: true,
        selectMonths: true
    });
});

function submitOnClick() {
    var dateFrom = $("#txtDateFrom");
    var dateTo = $("#txtDateTo");
    if (dateFrom.val() === "") {
        alert("Mohon pilih tanggal!");
        dateFrom.focus();
        return false;
    } else if (dateTo.val() === "") {
        alert("Mohon pilih tanggal!");
        dateTo.focus();
        return false;
    } else {
        $.ajax({
            type: "POST",
            url: "laporan-controller.php",
            data: {
                dateFrom: dateFrom.val(),
                dateTo: dateTo.val(),
                type: "tampil data"
            },
            success: function (res) {

                res = JSON.parse(res);
                if (res.length > 0) {
                    $("#tbody").html("");
                    for (var i = 0; i < res.length; i++) {
                        var o = res[i];
                        var count = i + 1;
                        $("#tbody").append("<tr>\
                        <td>" + count + "</td>\
                            <td> P" + o.id + "</td>\
                            <td>" + o.nomor_meja + "</td>\
                            <td id='td_pesanan_detail_" + o.id + "'></td>\
                            <td>" + o.total_harga + "</td>\
                        </tr>");


                        var listPesananDetail = o.list_pesanan_detail;
                        if (listPesananDetail !== null) {
                            for (var j = 0; j < listPesananDetail.length; j++) {
                                var detail = listPesananDetail[j];
                                $("#td_pesanan_detail_" + o.id).append(detail.jumlah +" " + detail.nama_pesanan + "<br>");
                            }
                        }
                    }
                }
            }
        });
    }
}


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