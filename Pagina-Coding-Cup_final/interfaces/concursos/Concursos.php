<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concursos</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/estilosTablaConcursos.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../dt/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != 1 && $_SESSION["tipo"] != 2) {
          header("Location: ../index.html");
          exit(); 
        } 

        require_once('../../datos/daoConcurso.php');
        $dao=new DAOConcurso();
        $listaConcursos=$dao->obtenerTodos();
    ?>
    <nav class="navbar navbar-expand-lg" style="background-color: #071a83;" data-bs-theme="dark">
        <div class="container-fluid">
            <nav class="navbar">
                <div class="container-nav" style="background-color: #071a83;">                  
                    <img src="../src/CCUP.png" alt="Bootstrap" width="50" height="35" style="background-color: #071a83;" role="img">
                  </a>
                </div>
            </nav>
              <label class="navbar-brand">Coding Cup</label>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">              
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../equipos/admonEquipos.php">Equipos</a>
              </li>
              <?php
                // Mostrar enlace "Usuarios" solo para el tipo 1 (Administrador)
                if ($_SESSION["tipo"] == 1) {
                    echo '<li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../auxiliar/tablaAuxiliar.php">Usuarios</a>
                          </li>';
                }
                if ($_SESSION["tipo"] == 1) {
                  echo '<li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="../couch/tabladecou copy.php">Coaches</a>
                        </li>';
                }
                ?>
            </ul>
          </div>
          <div>
            <ul class="navbar-nav mb-2 mb-lg-0" style="margin-right: 60px;">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <?=ISSET($_SESSION["nombre"])?$_SESSION["nombre"]:""?>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="../cerrarSesion.php">Cerrar Sesión</a></li>
                    </ul>
                  </li>
            </ul>
          </div>
        </div>
    </nav>

    <h1 class="text-center mt-2">Administrar Concursos</h1>
    <div class="d-grid gap-2 d-md-flex justify-content-md-center mx-auto mt-3">
        <!-- <button class="btn btn-success" type="button">Aprobar Todos</button> -->
        <button id="btnAgregar" class="btn" style="background-color: #071a83; color: white;">Agregar Concurso</button>
    </div>
    <div class="container">
        <table id="tblConcursos" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Concurso</th>
                    <th>Fecha de Apertura de Inscripción</th>
                    <th>Fecha de Cierre de Inscripción</th>
                    <th>Estatus</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody> 
            <?php 
                  foreach ($listaConcursos as $concurso){
                  echo "<tr><td>".$concurso->nombre."</td>".
                          "<td>".$concurso->fechaInicio."</td>".
                          "<td>".$concurso->fechaLimite."</td>".
                          "<td>".$concurso->estatus."</td>".
                          "<td><form method='post'>".
                              "<button formaction='registroConcursos.php' class='btn btn-primary' name='id' value='".
                              $concurso->id."' style='margin-right: 10px;'>Editar</button>".
                              "<button type='button' class='btn btn-warning' onclick='activarConcurso(" .
                               $concurso->id . ", \"" . $concurso->nombre . "\")' name='id' value='".$concurso->id."' style='margin-right: 10px;'>Activar</button>".
                               "<button type='button' class='btn btn-danger' onclick='desactivarConcurso(" .
                               $concurso->id . ", \"" . $concurso->nombre . "\")' name='id' value='".$concurso->id."' >Desactivar</button>".
                          "</form></td></tr>";
                  }
                ?>
            </tbody>
        </table>
    </div>

        <!-- MODAL PARA ACTIVAR -->
    <div class="modal" id="mdlConfirmacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title" style="color: black;">Confirmar activacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Está a punto de activar el concurso <strong id="spnConcurso"></strong>
            ¿Desea continuar?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="btnConfirmar">Sí, activar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL PARA INFORMAR DEL RESULTADO -->
  <div class="modal" id="mdlInformacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Catálogo de concursos</h5>
          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <div class="modal-body">
          El concurso ha sido activado con éxito
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCerrar">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

          <!-- MODAL PARA DESACTIVAR -->
          <div class="modal" id="mdlConfirmacion2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Confirmar activacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Está a punto de desactivar el concurso <strong id="spnConcurso2"></strong>
            ¿Desea continuar?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btnConfirmar2">Sí, desactivar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL PARA INFORMAR DEL RESULTADO DE ELIMINACION -->
  <div class="modal" id="mdlInformacion2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Catálogo de concursos</h5>
          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <div class="modal-body">
          El concurso ha sido desactivado con éxito
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCerrar2">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
        function activarConcurso(id,nombre) {
            $("#mdlConfirmacion").modal("show");
            
            $("#spnConcurso").text(nombre);
            
            $("#btnConfirmar").click(function() {
            
            $.ajax({
                url: "activarConcurso.php",
                type: "POST",
                data: { id: id }, 
                success: function(response) {     
                    $("#mdlInformacion").modal("show");
                    
                }
            });
        });
        }

        function desactivarConcurso(id,nombre) {
            $("#mdlConfirmacion2").modal("show");
            
            $("#spnConcurso2").text(nombre);
            
            $("#btnConfirmar2").click(function() {
            
            $.ajax({
                url: "desactivarConcurso.php",
                type: "POST",
                data: { id: id }, 
                success: function(response) {     
                    $("#mdlInformacion2").modal("show");
                    
                }
            });
        });
        }

        document.getElementById('btnCerrar').addEventListener('click', function() {
        location.reload();
        });

        document.getElementById('btnCerrar2').addEventListener('click', function() {
        location.reload();
        });
    </script>

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

    <script src="../js/concursos.js"></script>
</body>
</html>