<?php

require_once "models/Envio.php";
require_once "models/Usuario.php";
require_once "models/Area.php";
require_once "models/Estado.php";
require_once "models/Recepcion.php";

require_once "models/UsuarioArea.php";
require_once "MovimientoController.php";
require_once "DocumentoController.php";

class EnvioController{
    private Envio $envioModel;
    private Estado $estadoModel;
    private Area $areaModel;
    private Recepcion $recepcionModel;
    private UsuarioArea $usuarioAreaModel;
    private MovimientoController $movimientoController;
    private DocumentoController $documentoController;


    public function __construct(){
        $this->envioModel = new Envio();
        $this->areaModel = new Area();
        $this->movimientoController = new MovimientoController();
        $this->documentoController = new DocumentoController();
        $this->recepcionModel = new Recepcion();
        $this->usuarioAreaModel = new UsuarioArea();
    }

    // accion para obtener los documentos enviados
    public function enviados(){
        $this->envioModel->setCodEstado(Estado::getIdEstadoInactivo());
        $this->envioModel->setCodUsuarioAreaEnvio((int) $_SESSION['user']['codUsuarioArea']);
        $response = $this->envioModel->obtenerDocumentosEnviados();

        require_once "views/documentos/enviados.php";
    }

    public function cancelarEnvio(){
        if (isset($_POST['codEnvio'])){
            $this->envioModel->setCodEnvio($_POST['codEnvio']);
            $this->envioModel->cancelarEnvio();

            $this->redirect();
        }
    }

    public function detalle(){
        if(isset($_GET['cod'])){
            $codEnvio = $_GET['cod'];

            $this->envioModel->setCodEnvio((int) $codEnvio);
            $response = $this->envioModel->obtenerDetalleEnvio();
            //var_dump($response);

        }
        require_once "views/documentos/detalleEnvio.php";
    }

    public function obtenerFechaActual(){
        date_default_timezone_set('America/Lima');
        return date('Y-m-d');
    }

    public function obtenerHoraActual(){
        date_default_timezone_set('America/Lima');
        return date('H:i');
    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "documento";
    }

    public function goBack(){
        echo '<script type="text/javascript">
        window.history.back();
        </script>';
    }

    public function redirect(){
        echo '<script type="text/javascript">
        window.location.href = "enviados";
        </script>';
    }
}