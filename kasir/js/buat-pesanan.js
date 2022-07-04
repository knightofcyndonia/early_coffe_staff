$(document).ready(function () {});

function tambahPesanan() {

    $(".dataTables_empty").hide();
    var length = $(".ddlMenu").length;
    var count = length + 1;
    $("#tbodyNew").append("<tr>\
        <td><select onchange='menuOnChange(this)' id='ddlMenu_" + count + "' class='ddlMenu form-control' name='ddlMenu[]'></select>\
        <input type='hidden' name='txtNamaMenu[]' class='txtNamaMenu'  readonly/>\
        </td>\
        <td><input type='number' maxlength='12' onchange='jumlahOnChange(this)' onkeypress='return isNumberKey(event, this)' class='txtJumlah form-control' name='txtJumlah[]' /></td>\
        <td><input type='text' readonly class='txtHarga form-control' name='txtHarga[]' /></td>\
        <td><input type='text' readonly class='txtTotalHarga form-control' name='txtTotalHarga[]'/></td>\
        <td style='text-align:center'>\
            <button type='button' onclick='deleteItem(this)'class='btn btn-icon btn-outline-danger'><i class='feather icon-trash'></i></button>\
        </td>\
        </tr>");
    for (var i = 0; i < listMenu.length; i++) {
        var menu = listMenu[i];
        $("#ddlMenu_" + count).append("<option value='" + menu.id + "'>" + menu.nama_menu + "</option>");
    }
}

function deleteItem(o) {
    $(o).parent().parent().remove();
}

function menuOnChange(o) {
    var index = $(".ddlMenu").index(o);
    setHargaAndTotal(index);
}

function jumlahOnChange(o) {
    var index = $(".txtJumlah").index(o);
    setHargaAndTotal(index);
}

function setHargaAndTotal(i) {
    var id_menu = $(".ddlMenu")[i].value;
    var jumlah = $(".txtJumlah")[i].value;
    if (jumlah === "") {
        jumlah = "0";
    }
    jumlah = parseFloat(jumlah);

    var object = listMenu.find(x => x.id === id_menu);

    $(".txtNamaMenu")[i].value = object.nama_menu;

    var harga = object.harga;
    if (harga === "") harga = "0";
    harga = parseFloat(harga);

    total = jumlah * harga;

    $(".txtHarga")[i].value = harga;
    $(".txtTotalHarga")[i].value = total;
}

function pesan() {
    var listOfMenu = $(".ddlMenu");
    var listOfJumlah = $(".txtJumlah");
    var txtNomorMeja = $("#txtNomorMeja");
    var txtNama = $("#txtNama");
    
    if(txtNomorMeja.val() === ""){
        alert("Mohon isi nomor meja!");
        $(txtNomorMeja).focus();
        return false;
    }
    if(txtNama.val() === ""){
        alert("Mohon isi nama!");
        $(txtNama).focus();
        return false;
    }
    if (listOfMenu.length < 1) {
        alert("Tidak bisa melakukan pesanan! Mohon isi satu pesanan!");
        return false;
    }
    for (var i = 0; i < listOfMenu.length; i++) {
        var jumlah = listOfJumlah[i];
        if (jumlah.value === "") {
            alert("Mohon isi jumlah");
            $(jumlah).focus();
            return false;
        }
    }
    Swal.fire({
        title: 'Buat Pesanan?',
        text: "Pastikan data sudah benar?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28c76f',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Setuju!',
        cancelButtonText: 'Tidak!',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-outline-danger ml-1',
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "pesanan-controller.php",
                data: $("#frm").serialize() + "&type=buat pesanan dari kasir",
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
                            window.location = 'buat-pesanan.php';
                        });
                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: res,
                            type: "success",
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        }).then((result) => {
                            window.location = 'home.php';
                        });
                    }

                }

            });
        }

    });
}

function getPesananByNomorMeja() {
    var nomor_meja = $("#txtNomorMeja").val();
    if (nomor_meja !== "") {
        $.ajax({
            type: "POST",
            url: "pesanan-controller.php",
            data: {
                type: "tampil data pesanan dari nomor meja",
                nomor_meja: nomor_meja
            },
            success: function (res) {

                res = JSON.parse(res);
                $("#tbodyPrev").html("");

                if (res.length > 0) {
                    var pesanan = res[0];
                    $("#txtNama").val(pesanan.nama_pelanggan);
                    $("#txtNama").prop("readonly", true);
                    var listPesananDetail = pesanan.list_pesanan_detail;
                    var count = 0;
                    for (var i = 0; i < listPesananDetail.length; i++) {
                        count = i + 1;
                        var pesananDetail = listPesananDetail[i];
                        var jumlah = parseFloat(pesananDetail.jumlah);
                        var harga = parseFloat(pesananDetail.harga);
                        var subtotal = jumlah * harga;
                        $("#tbodyPrev").append("<tr>\
                            <td><input readonly type='text' name='txtNamaMenu[]' class='form-control' value='" + pesananDetail.nama_pesanan + "' readonly/>\
                            <input type='hidden' class='form-control ddlMenu' value='" + pesananDetail.id + "' name='ddlMenu[]'></select>\
                            </td>\
                            <td><input readonly type='number' maxlength='12' value='" + jumlah + "' onkeypress='return isNumberKey(event, this)' class='txtJumlah form-control' name='txtJumlah[]' /></td>\
                            <td><input readonly type='text' value='" + harga + "' readonly class='txtHarga form-control' name='txtHarga[]' /></td>\
                            <td><input readonly type='text' value='" + subtotal + "' readonly class='txtTotalHarga form-control' name='txtTotalHarga[]'/></td>\
                            <td style='text-align:center'>\
                            </td>\
                            </tr>");
                    }
                } else {
                    $("#txtNama").val("");
                    $("#txtNama").prop("readonly", false);
                }
            }
        });
    } else {
        $("#txtNama").val("");
        $("#txtNama").prop("readonly", false);
        $("#tbodyPrev").html("");
    }
}