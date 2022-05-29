$(document).ready(function () {
    checkDevice();
    fnDataTableHome();
});

function checkDevice() {
    if (window.matchMedia('(max-width: 767px)').matches) {
        alert("Anda adalah kasir. Mohon buka di PC!");
    } else {
        return true;
    }
}

function fnDataTableHome() {

    var dataListView = $("#tblPesanan").DataTable({
        responsive: false,
        columnDefs: [{
            orderable: true,
            targets: 0,
        }],
        dom: '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
        oLanguage: {
            sLengthMenu: "_MENU_",
            sSearch: ""
        },
        aLengthMenu: [
            [10, 15, 20],
            [10, 15, 20]
        ],
        select: {
            style: "multi"
        },
        order: [
            [1, "asc"]
        ],
        bInfo: false,
        pageLength: 10,
        buttons: [{
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
}