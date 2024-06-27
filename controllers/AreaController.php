<?php
require_once "models/Documento.php";

class AreaController{

    public function crear(){
        require_once "views/area/registroArea.php";
    }

    public function registrarArea(){
        //$registrarArea = new Area();
        
        //$resultsRegistrarArea = $registrarArea->registrarArea();

    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "area";
    }
} 