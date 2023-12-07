<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        
        form .row > div{
            margin: .5rem 0;
        }
    </style>
</head>
<body>
    
<?php
    session_start();

    if (!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != 1) {
        header("Location: ../index.html");
        exit();
      } 
    
    

      require('menuAuxiliar.php');
      require_once('../../datos/daoAuxiliar.php');
      require_once('auxiliarUtil.php');
    ?>
    <div class="container mt-3">   

    <form action="" class="needs-validation" novalidate id="contenido" method="post" enctype="multipart/form-data">
    <h1>Registrar Usuario</h1>
        <!-- editar -->
        <input  type="hidden" name="operation" value="<?php echo isset($_POST['id']) ? 'edit' : 'add'; ?>">
        <input type="hidden" name="iden" value="<?= $auxiliar->id ?>">
        <!-- <input type="hidden" name="id" value="<?= $auxiliar->id ?>"> -->
        <!--  -->
            <div class="row">
                <div class="col-4">
                    <label for="txtNombre" class="form-label">Nombre:</label>
                    <input type="text" id="txtNombre" name="Nombre" class="form-control <?=$valNombre?>"
                    placeholder="Nombre" required value="<?= $auxiliar->nombre ?>">
                    <div class="invalid-feedback">
                        <ul>
                            <li>El nombre es obligatorio</li>
                            <li>Debe contener solo caracteres alfabéticos</li>
                            <li>Debe tener entre 2 y 50</li>
                        </ul>
                    </div>
                </div>
                <div class="col-4">
                    <label for="txtApellido1" class="form-label">Primer apellido:</label>
                    <input type="text" id="txtApellido1" class="form-control <?=$valApe1?>" 
                    name="Apellido1" placeholder="Primer apellido" value="<?= $auxiliar->apellido1 ?>">
                    <div class="invalid-feedback">
                        <ul>
                            <li>El primer apellido es obligatorio</li>
                            <li>Debe contener solo caracteres alfabéticos</li>
                            <li>Debe tener entre 2 y 50</li>
                        </ul>
                    </div>
                </div>
                <div class="col-4">
                    <label for="txtApellido2" class="form-label">Segundo apellido:</label>
                    <input type="text" id="txtApellido2" class="form-control <?=$valApe2?>" name="Apellido2" placeholder="Segundo apellido"
                    value="<?= $auxiliar->apellido2 ?>">
                    <div class="invalid-feedback">
                        <ul>
                            <li>Debe contener solo caracteres alfabéticos</li>
                            <li>Debe tener entre 2 y 50</li>
                        </ul>
                    </div>
                </div>

                <div class="col-6">
                    <label for="txtEmail" class="form-label">Correo:</label>
                    <input type="email" id="txtEmail"  name="Email" class="form-control <?=$valEmail?>"
                    placeholder="Correo electrónico" required value="<?= $auxiliar->email ?>">
                    <div class="invalid-feedback">
                        <ul>
                            <li>El correo electrónico es obligatorio</li>
                            <li>Debe tener un formato válido</li>
                        </ul>
                    </div>
                </div>
                
                <div class="form-group col-6">
                    <label for="cboTipo" class="form-label">Tipo:</label>
                    <select class="form-control <?=$valTipo?>" name = "Tipo" id="cboTipo">
                        <option value="0">-- Seleccionar --</option>                                                               
                        <option value="Administrador" <?= ($auxiliar->tipo == "Administrador") ? "selected" : ""; ?>>Administrador</option>
                        <option value="Auxiliar" <?= ($auxiliar->tipo == "Auxiliar") ? "selected" : ""; ?>>Auxiliar</option>
                    </select>
                    <div class="invalid-feedback">
                        Debe de seleccionar un usuario
                    </div>
                </div>   
                
                <div class="col-6">
                    <label for="txtContrasenia" class="form-label">Contraseña:</label>
                    <input type="password" id="txtContrasenia"  name="Password" class="form-control <?=$valPassword?>"
                    placeholder="Contraseña" required value="<?= $auxiliar->password ?>">
                    <div class="invalid-feedback">
                        <ul>
                            <li>La contraseña es requerida</li>
                            <li>Debe tener entre 6 y 15 caracteres</li>
                        </ul>
                    </div>
                </div>

                <div class="col-6">
                    <label for="txtContrasenia2" class="form-label">Confirmar contraseña:</label>
                    <input type="password" name="Password2" id="txtContrasenia2" class="form-control <?=$valPassword2?>"
                    placeholder="Contraseña" required value="<?php echo ISSET($_POST["Password2"])?$_POST["Password2"]:"" ?>">
                    <div class="invalid-feedback">
                        <ul>
                            <li>Este campo es obligatorio</li>
                            <li>Las contraseñas no coinciden</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">                            
                <button id="btnGuardar" formaction="registroAuxiliar.php" class="btn" style="background-color: #071a83; color: white; width: 300px;">Guardar</button>
                <button type="button" id="btnVolver" class="btn btn-secondary" style="width: 300px; margin-left: 10px;">Cancelar</button>
            </div>
            
        </form>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/auxiliar.js"></script>
</body>
</html>