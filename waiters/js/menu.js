$(document).ready(function () {
    onSubmitClick();
    dropzoneOnClick();
});

function onSubmitClick() {
    var form = $("#form");
    $("#form").submit(function () {
        if (form[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            var type = $("#btnSubmit").val();
            var formData = new FormData(this);
            var file_name = $("#gambar");

            if (type === "Add Data") {
                if ($("#gambar")[0].files[0] === undefined) {
                    alert("Mohon masukkan gambar!");
                    $("#gambar").focus();
                    return false;
                }
            }
            else{
                if ($("#gambar")[0].files[0] !== undefined) {
                    formData.append($("#gambar")[0].files[0], file_name);
                }
            }
            formData.append("type", type);
            $.ajax({
                type: "POST",
                url: "menu-controller.php",
                processData: false,
                contentType: false,
                data: formData,
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
                            title: "Berhasil!",
                            text: res,
                            type: "success",
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        }).then((result) => {
                            window.location = 'menu.php';
                        });
                    }

                }
            })
        }
        form.addClass('was-validated');

    });
}

function fnDelete($id) {
    Swal.fire({
        title: 'Hapus?',
        text: "Apakah anda yakin ingin menolak pesanan?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28c76f',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!',
        cancelButtonText: 'Tidak!',
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-warning ml-1',
        buttonsStyling: false,
    }).then(function (result) {

        if (result.value) {
            $.ajax({
                type: "POST",
                url: "menu-controller.php",
                data: "id=" + $id + "&type=hapus",
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
                                window.location = 'menu.php';
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
                            if (result.value) {
                                window.location = 'menu.php?';
                            }
                        });
                    }

                }
            })
        }

    })
}

function dropzoneOnClick() {
    $("#dropzone").click(function () {
        $("#file_upload").trigger("click");
    });
}

function dropzoneOnDrag() {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
}

function fnDropzone() {
    var myDropzone = new Dropzone("#dropzone", {
        url: "upload.php",
        paramName: "file",
        maxFilesize: 2,
        maxFiles: 10,
        acceptedFiles: "image/*,application/pdf",
        autoProcessQueue: false
    });

}

function fnDataTableMenu(tableId) {

    var dataListView = $("#" + tableId).DataTable({
        responsive: false,
        columnDefs: [{
                orderable: true,
                targets: 0
            },
            {
                targets: 5,
                orderable: false
            }
        ],
        dom: '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
        oLanguage: {
            sLengthMenu: "_MENU_",
            sSearch: ""
        },
        aLengthMenu: [
            [10, 15, 20],
            [10, 15, 20]
        ],
        order: [
            [1, "asc"]
        ],
        bInfo: false,
        pageLength: 10,
        buttons: [{
            text: "<i class='feather icon-plus'></i> Tambah Menu",
            action: function () {
                $(this).removeClass("btn-secondary")
                $(".add-new-data").addClass("show")
                $(".overlay-bg").addClass("show")
                $("#btnUpdateData").text("Tambah Data");
                $('#newNama').val("");
                $('#newJenis').val("Makanan");
                $("#newHarga").val("");
                $("#btnSubmit").val("Add Data");
            },
            className: "btn-outline-primary"
        }],
        initComplete: function (settings, json) {
            $(".dt-buttons .btn").removeClass("btn-secondary")
        }
    });

    // Scrollbar
    if ($(".data-items").length > 0) {
        new PerfectScrollbar(".data-items", {
            wheelPropagation: false
        })
    }
    // Close sidebar
    $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function () {
        $(".add-new-data").removeClass("show")
        $(".overlay-bg").removeClass("show")
        $("#data-name, #data-price").val("")
        $("#data-category, #data-status").prop("selectedIndex", 0)
    })
}

function fnEdit(object) {
    var id = $(object).parent().siblings("td:eq(1)").find(".id").val().trim();
    var nama = $(object).parent().siblings("td:eq(2)").text().trim();
    var jenis = $(object).parent().siblings("td:eq(3)").text().trim();
    var harga = $(object).parent().siblings("td:eq(4)").text().trim();
    var nama_gambar = $(object).parent().siblings("td:eq(1)").find(".nama_gambar").val().trim();

    if(harga.includes("Rp.")){
        harga = harga.replace("Rp.", "").trim();
    }

    $("#newId").val(id);
    $("#newGambar").val(nama_gambar);
    $('#newNama').val(nama);
    $('#newJenis').val(jenis);
    // $("#newJenis").trigger("chosen:updated");
    $("#newHarga").val(harga);
    $("#btnSubmit").val("Ubah Data");

    $(".add-new-data").addClass("show");
    $(".overlay-bg").addClass("show");
}