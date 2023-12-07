<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilosAdmonEquipos.css">
    <link rel="stylesheet" href="../dt/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
    <?php

        session_start();
            if (!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != 1 && $_SESSION["tipo"] != 2) {
            header("Location: ../index.html");
            exit();
        } 

        require_once('../../datos/daoEquipo.php');
        $dao=new DAOEquipo();
        $listaEquipos=$dao->obtenerTodosAdmin();
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

    <h1 class="text-center mt-2">Administrar Equipos</h1>
    <div class="d-grid gap-2 d-md-flex justify-content-md-center mx-auto mt-3">
        <!-- <button class="btn" type="button" id="btnDescargarEquipos" style="background-color: #071a83; color: white;">Descargar Lista de Equipos</button> -->
        <!-- <button class="btn btn-success" type="button">Descargar Usuarios y Contraseñas</button> -->
        <button class="btn btn-success" type="button" onclick="aprobarTodos()">Aprobar todos</button>

    </div>
    <div class="container">
        <table id="tblEquipos" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Equipo</th>
                    <th>Coach</th>
                    <th>Integrante 1</th>
                    <th>Integrante 2</th>
                    <th>Integrante 3</th>
                    <th>Institución</th>
                    <th>Estatus</th>
                    <th>Control</th>
                </tr>
            </thead>
            <tbody> 
            <?php    
                foreach ($listaEquipos as $equipo){
                echo "<tr><td>".$equipo->nombre."</td>".
                        "<td>".$equipo->coach."</td>".
                        "<td>".$equipo->integrante1."</td>".
                        "<td>".$equipo->integrante2."</td>".
                        "<td>".$equipo->integrante3."</td>".
                        "<td>".$equipo->institucion."</td>".
                        "<td>".$equipo->estatus."</td>".
                        "<td><form method='post'>".
                          "<button type='button' class='btn btn-warning' onclick='aprobarEquipo(" . $equipo->id . ")' name='id' value='".$equipo->id."' >Aprobar</button>".
                        "</form></td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>

    <script>
        function aprobarEquipo(id) {
            $.ajax({
                url: "aprobarEquipo.php",
                type: "POST",
                data: { id: id }, 
                success: function(response) {     
                    location.reload();    
                }
            });
        }

        function aprobarTodos() {
            $.ajax({
                url: "aprobarTodos.php",
                type: "POST",
                data: { }, 
                success: function(response) {     
                    location.reload();    
                }
            });
        }
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
    <script src="../js/admonEquipos.js"></script>
</body>
</html>