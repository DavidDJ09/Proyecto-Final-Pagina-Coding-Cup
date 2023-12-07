<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tabla de Couches</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/estilosRegistroCoach.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>
  <body>
    <?php
    session_start();

    if (!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != 1) {
        header("Location: ../index.html");
        exit();
      } 
        require_once('../../datos/daoCou.php');
        require_once('couUtil.php');
        $dao=new DAOCou();
        $listaCou=$dao->obtenerTodosAdmin();
        //var_dump($listaCou);
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
                <a class="nav-link active" aria-current="page" href="../concursos/Concursos.php">Concursos</a>
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
                              <a class="nav-link active" aria-current="page" href="../equipos/admonEquipos.php">Administrar equipos</a>
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

    <h1 class="text-center mt-2">Administrar Coaches</h1>
    <div class="container">
        <table id="tblCou"  class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Institucion</th>
                    <th>Acciones</th></tr>
            </thead>
            <tbody> 
                <?php
                    foreach ($listaCou as $cou){
                    echo "<tr><td>".$cou->nombreCompleto."</td>".
                            "<td>".$cou->username."</td>".
                            "<td>".$cou->institucion."</td>".
                            "<td><form method='post'>".
                            "<button formaction='editarCoach.php' class='btn btn-primary' name='id' value='".$cou->id."' " . " style='margin-right: 10px;'>Editar</button>".
                            "<button type='button' class='btn btn-danger' onclick='confirmarEliminacion(" . $cou->id . ", \"" .
                             $cou->nombreCompleto . "\")' name='id' value='".$cou->id."' " .">Eliminar</button>".
                            "</form></td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- MODAL PARA ELIMINAR -->
    <div class="modal" id="mdlConfirmar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
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
          <h5 class="modal-title">Catálogo de Couch</h5>
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
        function confirmarEliminacion(id,nombreCompleto) {
            $("#mdlConfirmar").modal("show");
            
            $("#spnPersona").text(nombreCompleto);
            
            $("#btnConfirmar").click(function() {
            
            $.ajax({
                url: "eliminarCou.php",
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


    <script src="../js/tabladeCou.js"></script>
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