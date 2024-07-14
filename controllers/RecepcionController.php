<?php

require_once "models/Recepcion.php";
require_once "models/Estado.php";
class RecepcionController{

    private Recepcion $recepcionModel;

    function __construct(){
        $this->recepcionModel = new Recepcion();
    }

    public function buscar($numRecepcion){
        $this->recepcionModel = new Recepcion();
        $this->recepcionModel->setCodRecepcion($numRecepcion);

        $response = $this->recepcionModel->existeRecepcion();

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

    public function pendientesDeRecepcion(){
        $response = $this->recepcionModel->getDocumentosPendientesRecepcion((int) $_SESSION['user']['codUsuario']);

        if ($response['status'] == 'failed'){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }

        require_once "views/documentos/pendientesDeRecepcion.php";
    }

    public function recepcionados(){
        $response = $this->recepcionModel->listarDocumentosRecepcionados((int) $_SESSION['user']['codUsuario']);

        if ($response['status'] == 'failed'){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }

        require_once "views/documentos/recepcionados.php";
    }

    public function confirmarRecepcion(){
        if(isset($_POST['codRecepcion'])){
            $codRecepcion = $_POST['codRecepcion'];

            $this->buscar(trim((int) $codRecepcion));
            $estadoCodActivo = Estado::getIdEstadoActivo();
            $this->recepcionModel->setFechaRecepcion($this->obtenerFechaActual());
            $this->recepcionModel->setHoraRecepcion($this->obtenerHoraActual());
            $this->recepcionModel->setCodRecepcion($codRecepcion);
            $this->recepcionModel->setCodEstado($estadoCodActivo);

            $response = $this->recepcionModel->cambiarEstadoRecepcion();

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

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "documento";
    }

    public function obtenerFechaActual(){
        date_default_timezone_set('America/Lima');
        return date('Y-m-d');
    }

    public function obtenerHoraActual(){
        date_default_timezone_set('America/Lima');
        return date('H:i');
    }

    public function redirect(){
        echo '<script type="text/javascript">
        window.location.href = "pendientesDeRecepcion";
        </script>';
    }

}