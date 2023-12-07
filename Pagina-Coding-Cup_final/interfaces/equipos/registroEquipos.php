<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Equipo</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilosRegistroEquipos.css">
</head>
<body>
    <?php
    session_start();
    if(!ISSET($_SESSION["id"])){
      header("Location:../index.html");
    }
    require('menuEquipos.php');
      require_once('../../datos/daoEquipo.php');
      require_once('equipoUtil.php');
    ?>
    
    <div class="container">
        <form action="" class="needs-validation" novalidate id="contenido" method="post" enctype="multipart/form-data"> 

            <!-- editar -->
            <input type="hidden" name="operation" value="<?php echo isset($_POST['id']) ? 'edit' : 'add'; ?>">
            <input type="hidden" name="iden" value="<?= $equipo->id ?>">
            <input type="hidden" name="id_couch" value="<?= $_SESSION["id"] ?>">
            <input type="hidden" name="institucion" value="<?= $_SESSION["institucion"] ?>">
            <!--  -->

            <h1 id="titulo">Registro de Equipo</h1>
            <div class="mb-3">
                <span id="spnClave"></span>
            </div>

            <div class="mb-3">
                <label for="txtNombre" class="form-label">* Nombre del equipo</label>
                <input type="text" name="Nombre" id="txtNombre" required minlength="5" maxlength="50" class="form-control <?=$valNombre?>" 
                    value="<?= $equipo->nombre ?>">
                <div id="validationServer01Feedback" class="invalid-feedback">
                    <ul>
                        <li>El nombre de equipo es obligatorio</li>
                        <li>Longitud mínima de 5 caracteres</li>
                    </ul>                 
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="txtEstu1" class="form-label">* Estudiante 1</label>
                        <div class="form-floating mb-3">
                            <input type="text" name="Estu1" id="txtEstu1" required minlength="10" maxlength="50" 
                                class="form-control <?=$valEstu1?>" placeholder="Nombre completo" value="<?= $equipo->integrante1 ?>">
                            <label for="txtEstu1">Nombre completo</label>
                            <div id="validationServer02Feedback" class="invalid-feedback">
                                <ul>
                                    <li>El nombre del estudiante 1 es obligatorio</li>
                                    <li>Longitud mínima de 10 caracteres</li>
                                    <li>Solo caracteres alfabéticos</li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="txtEstu2" class="form-label">* Estudiante 2</label>
                        <div class="form-floating mb-3">
                            <input type="text" name="Estu2" id="txtEstu2" required minlength="10" maxlength="50" 
                                class="form-control <?=$valEstu2?>" placeholder="Nombre completo" value="<?= $equipo->integrante2 ?>">
                            <label for="txtEstu2">Nombre completo</label>
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                <ul>
                                    <li>El nombre del estudiante 2 es obligatorio</li>
                                    <li>Longitud mínima de 10 caracteres</li>
                                    <li>Solo caracteres alfabéticos</li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="txtEstu3" class="form-label">* Estudiante 3</label>
                        <div class="form-floating mb-3">
                            <input type="text" name="Estu3" id="txtEstu3" required minlength="10" maxlength="50" 
                                class="form-control <?=$valEstu3?>" placeholder="Nombre completo" value="<?= $equipo->integrante3 ?>">
                            <label for="txtEstu3">Nombre completo</label>
                            <div id="validationServer06Feedback" class="invalid-feedback">
                                <ul>
                                    <li>El nombre del estudiante 3 es obligatorio</li>
                                    <li>Longitud mínima de 10 caracteres</li>
                                    <li>Solo caracteres alfabéticos</li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                </div>

            <div class="botones">
                <button id="btnGuardar" class="btn" style="background-color: #071a83; color: white; width: 300px;">Guardar</button>
                <!-- <button type="reset" id="btnLimpiar" class="btn btn-warning">Limpiar</button> -->
                <button type="button" id="btnVolver" class="btn btn-secondary" style="width: 300px;">Cancelar</button>            
            </div>
        </form>
      </div>

      <script src="../js/bootstrap.bundle.min.js"></script>
      <script src="../js/equipo.js"></script>
</body>
</html>