//custom data table

$(document).ready(function () {
    // onLoadValidation();
    
});

function isNumberKey(evt, obj) {

  var charCode = (evt.which) ? evt.which : event.keyCode;
  var value = obj.value;
  var dotcontains = value.indexOf(".") !== -1;
  if (dotcontains)
      if (charCode === 46)
          return false;
  if (charCode === 46)
      return true;
  if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
  return true;
}

// function onLoadValidation() {
//     if ($("#nomor_meja").val() === "") {
//       $(".app-content, nav, footer").remove();
//       $("body").append("Terjadi kesalahan, mohon hubungi kasir atau waiters!");
//       Swal.fire({
//         title: "Error!",
//         text: "Tidak Dapat Membuka halaman!",
//         type: "error",
//         confirmButtonClass: 'btn btn-primary',
//         buttonsStyling: false,
//       });
//       return false;
//     }
//     else{
//         $("#home").attr("href", "home.php?nomor_meja="+$("#nomor_meja").val());
//         $("#keranjang").attr("href", "keranjang.php?nomor_meja="+$("#nomor_meja").val());
//     }
//   }