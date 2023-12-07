document.addEventListener("DOMContentLoaded", ()=>{
    
    document.getElementById("btnAgregar").addEventListener('click',
        (e)=>{
        location.replace('registroAdmin.php');
    });

    if (!$.fn.dataTable.isDataTable('#tblUsuarios')) {
        //$("selector").funcion();
        tabla=$("#tblUsuarios").DataTable({
            columnDefs: [
                { orderable: false, targets: -1 }
            ],
            order: [[1, 'asc']],
        });
    } 
});