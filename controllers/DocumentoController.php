<?php
require_once "models/Documento.php";
require_once "TipoDocumentoController.php";
require_once "EstadoController.php";

class DocumentoController{

    public function obtenerFechaActual(){
        return date('Y-m-d');
    }

    public function crear(){
        $fechaActual = $this->obtenerFechaActual();

        $tipoDocObj = new TipoDocumentoController();
        $tiposDocumentos = $tipoDocObj->getTipoDocumentos();

        require_once "views/documentos/registrarDocumento.php";
    }

    public function registrar(){
        if (isset($_POST)){
            $estadoOjb = new EstadoController();
            $nroDocumento = isset($_POST['nroDocumento']) ? trim($_POST['nroDocumento']) : false;

            $documentoObj = new Documento();
            $documentoObj->setNumDocumento(trim($nroDocumento));

            $response = $documentoObj->existeDocumento();
            if ($response){
                $_SESSION['response'] = $response;
                require_once "views/modals/alerta.php";
                exit();
            }

                $asunto = isset($_POST['asunto']) ? trim($_POST['asunto']) : false;
                $folios = isset($_POST['folios']) ? trim($_POST['folios']) : false;
                $tipoDocumento = isset($_POST['tipoDocumento']) ? trim($_POST['tipoDocumento']) : false;
                $fechaRegistro = $this->obtenerFechaActual();
                $usuario = 1;   // usuario logeado
                $estado = $estadoOjb->getIdEstadoActivo();

                if ($nroDocumento && $asunto && $folios && $tipoDocumento && $fechaRegistro && $usuario && $estado){
                    $documentoObj->setAsunto(trim($asunto));
                    $documentoObj->setFolios(trim($folios));
                    $documentoObj->setTipoDocumento($tipoDocumento);
                    $documentoObj->setFechaRegistro($fechaRegistro);
                    $documentoObj->setUsuario($usuario);
                    $documentoObj->setEstado((int) $estado);

                    // var_dump($documentoObj);
                    //$response [status, message, info]
                    $response = $documentoObj->guardarNuevoDocumento();
                    $_SESSION['response'] = $response;
                    require_once "views/modals/alerta.php";
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