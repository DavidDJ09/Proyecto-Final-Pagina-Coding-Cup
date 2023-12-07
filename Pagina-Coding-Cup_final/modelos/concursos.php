<?php
    class Concurso{
        public $id=0;
        public $nombre="";
        public $fechaInicio;
        public $fechaLimite;
        public $estatus="";

        public function __construct(){
            $this->fechaInicio=new DateTime();
            $this->fechaLimite=new DateTime();
        }
    }
?>