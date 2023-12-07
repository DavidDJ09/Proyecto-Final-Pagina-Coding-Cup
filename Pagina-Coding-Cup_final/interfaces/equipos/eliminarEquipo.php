<?php
    require_once('../../datos/daoEquipo.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
        $id = $_POST["id"];
        $dao = new DAOEquipo();
        $dao->eliminar($id);
        header("Location: tablaEquipos.php");
        exit();
    } else {
    exit();
    }
?>