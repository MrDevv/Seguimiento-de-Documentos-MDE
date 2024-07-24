<?php
require_once "models/Documento.php";
require_once "TipoDocumentoController.php";
require_once "EstadoController.php";

class DocumentoController{
    private $envioModel;
    private $documentoModel;

    public function __construct(){
        $this->documentoModel = new Documento();
    }

    public function obtenerFechaActual(){
        date_default_timezone_set('America/Lima');
        return date('Y-m-d');
    }

    public function obtenerHoraActual(){
        date_default_timezone_set('America/Lima');
        return date('H:i');
    }

    public function listar(){
        $numDocumento = isset($_GET['numDoc']) ? $_GET['numDoc'] : null;

        if ($numDocumento){
            $this->documentoModel->setNumDocumento($numDocumento);
        }

        if(trim($_SESSION['user']['rol']) == 'administrador'){
            $response = $this->documentoModel->listarDocumentos();
        }else if(trim($_SESSION['user']['rol']) == 'usuario'){

            $this->documentoModel->setUsuario((int) $_SESSION['user']['codUsuarioArea']);

            $response = $this->documentoModel->listarDocumentos();
        }

        if ($response['status'] == 'failed'){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }
        require_once "views/documentos/listarDocumentos.php";
    }

    public function crear(){
        $fechaActual = $this->obtenerFechaActual();

        $tipoDocObj = new TipoDocumentoController();
        $tiposDocumentos = $tipoDocObj->getTipoDocumentos();

        require_once "views/documentos/registrarDocumento.php";
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
        require_once "views/modals/alerta.php";
    }

    public function finalizarSeguimiento(){
        if(isset($_POST['codDocumento'])){
            $numDocumento = $_POST['codDocumento'];

            $this->buscar(trim($numDocumento));
            $estadoCodInactivo = Estado::getIdEstadoInactivo();
            $documentoObj = new Documento();
            $documentoObj->setNumDocumento($numDocumento);
            $documentoObj->setEstado($estadoCodInactivo);

            $response = $documentoObj->cambiarEstadoDocumento();

            if ($response['status'] == 'failed'){
                $_SESSION['response'] = $response;
                require_once "views/modals/alerta.php";
                exit();
            }

            $this->redirect();

        }else{
            $this->redirect();
            exit();
        }
    }

    public function iniciarSeguimiento(string $numDocumento){
        $estadoCodActivo = Estado::getIdEstadoActivo();
        $documentoObj = new Documento();
        $documentoObj->setNumDocumento($numDocumento);
        $documentoObj->setEstado($estadoCodActivo);
        $response = $documentoObj->cambiarEstadoDocumento();
        if ($response['status'] == 'failed'){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
        }
    }

    public function reanudarSeguimiento(){
        if(isset($_POST['codDocumento'])){
            $numDocumento = $_POST['codDocumento'];

            $this->buscar(trim($numDocumento));
            $estadoCodActivo = Estado::getIdEstadoActivo();
            $documentoObj = new Documento();
            $documentoObj->setNumDocumento($numDocumento);
            $documentoObj->setEstado($estadoCodActivo);

            $response = $documentoObj->cambiarEstadoDocumento();

            if ($response['status'] == 'failed'){
                $_SESSION['response'] = $response;
                require_once "views/modals/alerta.php";
                exit();
            }

            $this->redirect();

        }else{
            $this->redirect();
            exit();
        }
    }

    public function seguimiento(){
        if (isset($_GET['doc'])){
            $this->documentoModel->setNumDocumento($_GET['doc']);
            $response = $this->documentoModel->verSeguimientoDocumento();

            require_once "views/documentos/seguimientoDocumento.php";
        }
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