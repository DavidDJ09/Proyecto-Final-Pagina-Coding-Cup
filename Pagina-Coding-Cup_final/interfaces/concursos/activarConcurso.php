<?php
    require_once('../../datos/daoConcurso.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
            $id = $_POST["id"];
            $dao = new DAOConcurso();
            $dao->activar($id);
            $dao->desactivarDemas($id);
            header("Location: Concursos.php");
        exit();
    } else {
    exit();
    }
?>