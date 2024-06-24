<?php
require_once "models/Documento.php";

class DocumentoController{

    public function pendientesDeRecepcion(){
        $documentosPendienteRecepcion = new Documento();

        $resultsPendientesRecepcion = $documentosPendienteRecepcion->getDocumentosPendientesRecepcion();

        require_once "views/documentos/pendientesDeRecepcion.php";
    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "documento";
    }
}