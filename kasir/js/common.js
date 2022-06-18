//custom data table

$(document).ready(function () {
    checkDevice();
});

function fnDataTableCustom(tableId) {
    var dataThumbView = $("#" + tableId).DataTable({
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
            [4, 10, 15, 20],
            [4, 10, 15, 20]
        ],
        order: [
            [1, "asc"]
        ],
        bInfo: false,
        pageLength: 4,
        buttons: [{}],
        initComplete: function (settings, json) {
            $(".dt-buttons .btn").removeClass("btn-secondary")
        }
    })

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

function checkDevice() {
    if (window.matchMedia('(max-width: 767px)').matches) {
        alert("Anda adalah kasir. Mohon buka di PC!");
    } else {
        return true;
    }
}

function checkDevice() {
    if (window.matchMedia('(max-width: 767px)').matches) {
        alert("Anda adalah kasir. Mohon buka di PC!");
    } else {
        return true;
    }
}


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

function fnDataTableCustomWithExport($id) {
    $('#' + $id).DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                text: 'JSON',
                action: function (e, dt, button, config) {
                    var data = dt.buttons.exportData();

                    $.fn.dataTable.fileSave(
                        new Blob([JSON.stringify(data)]),
                        'Export.json'
                    );
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ]
    });
}