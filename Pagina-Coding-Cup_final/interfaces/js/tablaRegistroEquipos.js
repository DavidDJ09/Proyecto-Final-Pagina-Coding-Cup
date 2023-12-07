document.addEventListener('DOMContentLoaded',()=>{

    document.getElementById("btnAgregar").addEventListener('click', () => {
        window.location.replace('registroEquipos.php');
    });

    $("#tblEquipos").DataTable({
        dom: 'Bfrtip',
        buttons: [
            'pageLength',
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0,1,2,3]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2,3]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0,1,2,3]
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
