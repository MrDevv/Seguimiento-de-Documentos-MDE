<?php
require_once "models/Documento.php";
require_once "TipoDocumentoController.php";
require_once "EstadoController.php";

class DocumentoController{

    public function obtenerFechaActual(){
        return date('Y-m-d');
    }

    public function listar(){
        $documentoObj = new Documento();

        $response = $documentoObj->listarDocumentos();

        if ($response['status'] == 'failed'){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }

//        var_dump($response);
        require_once "views/documentos/listarDocumentos.php";
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

    public function editar(){
        if (isset($_GET["doc"])){
            $tipoDocObj = new TipoDocumentoController();
            $documentoDB = new Documento();

            $numDocumento = $_GET["doc"];
            $response = $this->buscar($numDocumento);

            $documentoDB->setNumDocumento($numDocumento);
            $documentoDB->setTipoDocumento(trim($response['data'][0]['tipo documento']));
            $documentoDB->setAsunto(trim($response['data'][0]['asunto']));
            $documentoDB->setFolios((int)$response['data'][0]['folios']);
            $documentoDB->setFechaRegistro($response['data'][0]['fechaRegistro']);

            $tiposDocumentos = $tipoDocObj->getTipoDocumentos();
            require_once "views/documentos/editarDocumento.php";
        }else{
            $this->redirect();
        }
    }

    public function buscar($numDocumento){
        $documentoObj = new Documento();
        $documentoObj->setNumDocumento($numDocumento);

        $response = $documentoObj->existeDocumento();

        if ($response['status'] == 'failed'){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }

        if (count($response['data'])== 0){
            $response['status'] = 'not found';
            $response['action'] = 'actualizar';
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }

        return $response;
    }

    public function actualizar(){
        $numDocumento = isset($_POST['nroDocumento']) ? $_POST['nroDocumento'] : false;
        $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : false;
        $folios = isset($_POST['folios']) ? $_POST['folios'] : false;
        $tipoDocumento = isset($_POST['tipoDocumento']) ? $_POST['tipoDocumento'] : false;

        if (!$numDocumento || !$asunto || !$folios || !$tipoDocumento){
            $this->redirect();
            exit();
        }

        $documentoObj = new Documento();
        $documentoObj->setNumDocumento($numDocumento);
        $documentoObj->setAsunto($asunto);
        $documentoObj->setFolios((int) $folios);
        $documentoObj->setTipoDocumento((int) $tipoDocumento);

        $response = $documentoObj->actualizar();

        $_SESSION['response'] = $response;
//        var_dump($documentoObj);
        var_dump($response);
        require_once "views/modals/alerta.php";
    }

    public function pendientesDeRecepcion(){
        $documentosPendienteRecepcion = new Documento();

        $resultsPendientesRecepcion = $documentosPendienteRecepcion->getDocumentosPendientesRecepcion();

        require_once "views/documentos/pendientesDeRecepcion.php";
    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "documento";
    }

    public function redirect(){
        echo '<script type="text/javascript">
        window.location.href = "listar";
        </script>';
//        header('Location:'.base_url."tipoDocumento/crear");
    }
}