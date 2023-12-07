let mdlConfirmacion;

document.addEventListener('DOMContentLoaded',()=>{
    $("#lista").DataTable({
        dom: 'Bfrtip',
        buttons: [
            'pageLength',
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0,1,2]
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

    mdlConfirmacion = document.getElementById('mdlConfirmacion')
    mdlConfirmacion.addEventListener('show.bs.modal', event => {
        let clave=event.relatedTarget.value;
        //Cargar el nombre de la persona a eliminar tomado de la primera celda
        document.getElementById("spnPersona").innerText=
        event.relatedTarget.closest("tr").children[0].innerText;
        
        //Cargar la clave en el value del botón "SI"
        document.getElementById("btnConfirmar").value=clave;
    });

});

function confirmar(btn){
    //Colocar en el span el nombre de quien eliminar
    const mdlEliminar = new bootstrap.Modal('#mdlConfirmacion', {
        backdrop:'static'
    });
    mdlEliminar.show(btn);
}

