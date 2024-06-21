<?php
class DocumentoController{

    public function pendientesDeRecepcion(){
        require_once "views/documentos/pendientesDeRecepcion.php";
    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "documento";
    }
}