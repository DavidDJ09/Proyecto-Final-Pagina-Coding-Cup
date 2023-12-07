<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Equipos</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilosTablaEquipos.css">
    <link rel="stylesheet" href="dt/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="dt/Buttons-2.4.2/css/buttons.bootstrap5.min.css">
</head>
<body>


<nav class="navbar navbar-expand-lg" style="background-color: #071a83;" data-bs-theme="dark">
    <div class="container-fluid">
      <nav class="navbar">
        <div class="container-nav" style="background-color: #071a83;">                  
            <img src="src/CCUP.png" alt="Bootstrap" width="50" height="35" style="background-color: #071a83;" role="img">
          </a>
        </div>
    </nav>
      <label class="navbar-brand">Coding Cup</label>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="aterrizaje.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="equipos\tablaEquipos.php">Equipos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="equipos\registroEquipos.php">Registrar Equipo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="equipos\admonEquipos.php">Administrar equipos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="auxiliar\tablaAuxiliar.php">Administrar Usuarios</a>
          </li>


        </ul>
      </div>
    </div>

    <div>
        <ul class="navbar-nav mb-2 mb-lg-0" style="margin-right: 150px;">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?=ISSET($_SESSION["tipo"])?$_SESSION["tipo"]:""?>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
              </li>
        </ul>
        </div>
</nav>
        

 
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="dt/jQuery-3.7.0/jquery-3.7.0.min.js"></script>
    <script src="dt/DataTables-1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="dt/DataTables-1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="dt/Buttons-2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="dt/Buttons-2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="dt/JSZip-3.10.1/jszip.min.js"></script>
    <script src="dt/pdfmake-0.2.7/pdfmake.min.js"></script>
    <script src="dt/pdfmake-0.2.7/vfs_fonts.js"></script>
    <script src="dt/Buttons-2.4.2/js/buttons.html5.min.js"></script>
    <script src="dt/Buttons-2.4.2/js/buttons.print.min.js"></script>
    <script src="dt/Buttons-2.4.2/js/buttons.colVis.min.js"></script>

</body>
</html>