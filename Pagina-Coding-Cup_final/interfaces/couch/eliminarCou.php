<?php
    require_once('../../datos/daoCou.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
        $id = $_POST["id"];
        $dao = new DAOCou();
        $dao->eliminar($id);
        header("Location: tabladecou.php");
        exit();
    } else {
    exit();
    }
?>