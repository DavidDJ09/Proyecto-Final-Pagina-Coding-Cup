<?php
    require_once('../../datos/daoEquipo.php');
    // Verifica si se ha enviado una solicitud POST y si se ha proporcionado un ID válido
    if ($_SERVER["REQUEST_METHOD"]) {
    // Crea una instancia de la clase DAOUsuario
    $dao = new DAOEquipo();
    // Llama al método eliminar del DAOUsuario para eliminar el registro
    $dao->aprobarTodos();
    // Redirecciona al usuario a la página deseada después de eliminar el registro
    header("Location: admonEquipos.php");
    exit();
    } else {
    exit();
    }
?>