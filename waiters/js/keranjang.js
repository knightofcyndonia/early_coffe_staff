$(document).ready(function () {
    // Default Spin
    // $(".touchspin").TouchSpin({
    //     buttondown_class: "btn btn-primary",
    //     buttonup_class: "btn btn-primary",
    // });

    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

    jumlahChange();
    namaChange();
    calculateTotalharga();
    onsubmit();
    setButton();
});

function setButton(){
    if($(".card-item-belum-dipesan").length <= 0 ){
        $("#div-pesan").remove();
    }
}

function namaChange(){
    $("#txtNama").change(function(){
        if(this.value !== ""){
            $("#alert-nama").css("display", "none");
        }   
    })
}

function removeItem(o) {
    if ($(".card-item-menu").length > 1) {
        $(o).parent().parent().parent().parent().remove();
        calculateTotalharga();
    } else {
        Swal.fire({
            title: "Gagal!",
            text: "Minimal insert 1 menu",
            type: "error",
            confirmButtonClass: 'btn btn-primary',
            buttonsStyling: false,
        }).then((result) => {});
    }
}

function jumlahChange() {
    $(".txtJumlah").change(function () {
        calculateTotalharga();
    });
}

function calculateTotalharga() {
    var total = 0;
    var listJumlah = $(".txtJumlah");
    var listHarga = $(".txtHarga");
    for (var i = 0; i < listJumlah.length; i++) {
        var jumlah = listJumlah[i].value;
        if (jumlah === "") {
            jumlah = "0";
        }
        jumlah = parseFloat(jumlah);

        var harga = listHarga[i].value;
        if (harga === "") {
            harga = "0";
        }
        harga = parseFloat(harga);

        var subtotal = harga * jumlah;
        total = total + subtotal;
    }

    $("#totalHarga").text("RP. " + total);
}

function onsubmit() {
    var nomor_meja = $("#txtNomorMeja").val();
    $("#btnSubmit").click(function () {
        if ($("#txtNama").val().trim() === "") {
            alertMsg();
        } else {
            Swal.fire({
                title: "Warning!",
                text: "Apakah anda ingin memesan? (pastikan pesanan anda sudah benar!)",
                type: "warning",
                confirmButtonText: 'Iya',
                cancelButtonText: 'Tidak',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-outline-danger ml-1',
                buttonsStyling: false,
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type:"POST",
                        url : "pesanan-controller.php",
                        data: $("#frm").serialize() + "&type=buat pesanan",
                        success: function (res) {
                            console.log(res);
                            if (res.includes("Gagal")) {
                                Swal.fire({
                                    title: "Gagal!",
                                    text: res,
                                    type: "error",
                                    confirmButtonClass: 'btn btn-primary',
                                    buttonsStyling: false,
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = 'keranjang.php?nomor_meja=' + nomor_meja;
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
                                        window.location = 'keranjang.php?nomor_meja=' + nomor_meja;
                                    }
                                });
                            }
        
                        }

                    });
                }
            });
        }

    });
}

function alertMsg(){
    $("#txtNama").focus();
    $("#alert-nama").css("display", "block");
}