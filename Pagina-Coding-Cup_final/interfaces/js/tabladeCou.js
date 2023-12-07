document.addEventListener('DOMContentLoaded',()=>{
    $("#tblCou").DataTable({
        dom: 'Bfrtip',
        buttons: [
            'pageLength',
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [1]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [1]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [1]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [1]
                }
            },
            'colvis'
        ],
        stateSave: true,
        columnDefs: [
            { orderable: false, targets: -1 }
        ],
        order: [[1, 'asc'],[2,'desc']]
    });
});