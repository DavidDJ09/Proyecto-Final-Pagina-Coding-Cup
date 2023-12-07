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
              <a class="nav-link active" aria-current="page" href="../equipos/admonEquipos.php">Administrar equipos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../concursos/Concursos.php">Concursos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../couch/tabladecou copy.php">Coaches</a>
              </li>
            </ul>
          </div>
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
</nav>