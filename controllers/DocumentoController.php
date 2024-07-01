<?php
require_once "models/Documento.php";
require_once "models/TipoDocumento.php";

class DocumentoController{

    public function obtenerFechaActual(){
        return date('Y-m-d');
    }

    public function crear(){
        $fechaActual = $this->obtenerFechaActual();
        $tipoDocObj = new tipoDocumento();
        $tiposDocumentos = $tipoDocObj->listarTipoDocumentos();

        require_once "views/documentos/registrarDocumento.php";
    }

    public function registrar(){
        if (isset($_POST)){
            $nroDocumento = isset($_POST['nroDocumento']) ? trim($_POST['nroDocumento']) : false;
            $asunto = isset($_POST['asunto']) ? trim($_POST['asunto']) : false;
            $folios = isset($_POST['folios']) ? trim($_POST['folios']) : false;
            $tipoDocumento = isset($_POST['tipoDocumento']) ? trim($_POST['tipoDocumento']) : false;
            $fechaRegistro = $this->obtenerFechaActual();

            if ($nroDocumento && $asunto && $folios && $tipoDocumento && $fechaRegistro){
                $documentoObj = new Documento();
                $documentoObj->setNroDocumento($nroDocumento);
                $documentoObj->setAsunto($asunto);
                $documentoObj->setFolios($folios);
                $documentoObj->setTipoDocumento($tipoDocumento);
                $documentoObj->setFechaRegistro($fechaRegistro);

//                var_dump($documentoObj);
//                $response [status, message, info]
                $response = $documentoObj->guardarNuevoDocumento();
                var_dump($response);
                //$_SESSION['response'] = $response;
                //require_once "views/modals/alerta.php";
            }
        }
    }

    public function pendientesDeRecepcion(){
        $documentosPendienteRecepcion = new Documento();

        $resultsPendientesRecepcion = $documentosPendienteRecepcion->getDocumentosPendientesRecepcion();

        require_once "views/documentos/pendientesDeRecepcion.php";
    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "documento";
    }
}