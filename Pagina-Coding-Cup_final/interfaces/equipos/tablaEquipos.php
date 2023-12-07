<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Equipos</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilosTablaEquipos.css">
    <link rel="stylesheet" href="../dt/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../dt/Buttons-2.4.2/css/buttons.bootstrap5.min.css">

</head>
<body>
    <?php
        session_start();
        if(!ISSET($_SESSION["id"])){
          if($_SESSION["id"]!=1){
            header("Location:../index.html");
          }
        }
        require('menuEquipos.php');
        require_once('../../datos/daoEquipo.php');
        require_once('../../datos/daoConcurso.php');
        $dao=new DAOEquipo();
        $daoCon=new DAOConcurso();

        //SABER SI HAY UN CONCURSO ACTIVO
        $concursoHabilitado=$daoCon->obtenerTodosCuenta();
        //MOSTRAR SOLO LOS EQUIPOS DEL COACH QUE INICIO SESION
        $listaEquipos=$dao->obtenerTodos($_SESSION["id"]);
    ?>

    <div class="container" id="contenido">
    <h1 class="text-center mt-2">Equipos Registrados</h1>

        <!-- <h1 style="margin-bottom: 20px;">Equipos Registrados</h1> -->
        <?php
          // Deshabilitar botones si no hay concurso activo
          $botonesDeshabilitados = !$concursoHabilitado;
        ?>

    <button id="btnAgregar" class="btn" style="background-color: #071a83; color: white;" <?php echo $botonesDeshabilitados ? 'disabled' : ''; ?>>Agregar</button>

        <table id="tblEquipos" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nombre de Equipo</th>
                    <th>Integrante 1</th>
                    <th>Integrante 2</th>
                    <th>Integrante 3</th>
                    <th>Operaciones</th></tr>
            </thead>
            <tbody> 
                <?php
                    
                    foreach ($listaEquipos as $equipo){
                    echo "<tr><td>".$equipo->nombre."</td>".
                            "<td>".$equipo->integrante1."</td>".
                            "<td>".$equipo->integrante2."</td>".
                            "<td>".$equipo->integrante3."</td>".
                            "<td><form method='post'>".
                            "<button formaction='registroEquipos.php' class='btn btn-primary' name='id' value='".$equipo->id."' " .
                            ($botonesDeshabilitados ? 'disabled' : '') . " style='margin-right: 10px;'>Editar</button>".


                            "<button type='button' class='btn btn-danger' onclick='confirmarEliminacion(" . $equipo->id . ", \"" .
                             $equipo->nombre . "\")' name='id' value='".$equipo->id."' " . ($botonesDeshabilitados ? 'disabled' : '') .">Eliminar</button>".
                            "</form></td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- MODAL PARA ELIMINAR -->
    <div class="modal" id="mdlConfirmacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Confirmar eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Está a punto de eliminar al equipo <strong id="spnPersona"></strong>
            ¿Desea continuar?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btnConfirmar">Sí, continuar con la eliminación</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL PARA INFORMAR DEL RESULTADO DE ELIMINACION -->
  <div class="modal" id="mdlInformacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Catálogo de equipos</h5>
          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <div class="modal-body">
          El registro ha sido eliminado
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCerrar">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
    <script>
        function confirmarEliminacion(id,nombre) {
            $("#mdlConfirmacion").modal("show");
            
            $("#spnPersona").text(nombre);
            
            $("#btnConfirmar").click(function() {
            
            $.ajax({
                url: "eliminarEquipo.php",
                type: "POST",
                data: { id: id }, 
                success: function(response) {     
                    $("#mdlInformacion").modal("show");
                    
                }
            });
        });
        }

        document.getElementById('btnCerrar').addEventListener('click', function() {
        location.reload();
        });
    </script>

    <script src="../js/tablaRegistroEquipos.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../dt/jQuery-3.7.0/jquery-3.7.0.min.js"></script>
    <script src="../dt/DataTables-1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="../dt/DataTables-1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="../dt/Buttons-2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="../dt/Buttons-2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="../dt/JSZip-3.10.1/jszip.min.js"></script>
    <script src="../dt/pdfmake-0.2.7/pdfmake.min.js"></script>
    <script src="../dt/pdfmake-0.2.7/vfs_fonts.js"></script>
    <script src="../dt/Buttons-2.4.2/js/buttons.html5.min.js"></script>
    <script src="../dt/Buttons-2.4.2/js/buttons.print.min.js"></script>
    <script src="../dt/Buttons-2.4.2/js/buttons.colVis.min.js"></script>

</body>
</html>