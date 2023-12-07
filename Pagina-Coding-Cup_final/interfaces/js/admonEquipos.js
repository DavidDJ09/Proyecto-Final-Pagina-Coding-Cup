document.addEventListener('DOMContentLoaded',()=>{
    var table=$("#tblEquipos").DataTable({
        dom: 'Bfrtip',
        buttons: [
            'pageLength',
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0,1,5],
                    format: {
                        body: function ( data, row, column, node ) {
                            // Solo exportar la fila si la columna 6 es "Aprobado"
                            return table.cell({row:row, column:6}).data() == 'Aprobado' ? data : '';
                        }
                    }
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,5],
                    format: {
                        body: function ( data, row, column, node ) {
                            // Solo imprimir la fila si la columna 6 es "Aprobado"
                            return table.cell({row:row, column:6}).data() == 'Aprobado' ? data : '';
                        }
                    }
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,5],
                    format: {
                        body: function ( data, row, column, node ) {
                            // Solo exportar la fila si la columna 6 es "Aprobado"
                            return table.cell({row:row, column:6}).data() == 'Aprobado' ? data : '';
                        }
                    }
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0,1,5],
                    format: {
                        body: function ( data, row, column, node ) {
                            // Solo exportar la fila si la columna 6 es "Aprobado"
                            return table.cell({row:row, column:6}).data() == 'Aprobado' ? data : '';
                        }
                    }
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