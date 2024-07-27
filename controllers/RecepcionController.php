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

    public function recepcionados(){
        $response = $this->recepcionModel->listarDocumentosRecepcionados((int) $_SESSION['user']['codUsuarioArea']);

        if ($response['status'] == 'failed'){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }

        require_once "views/documentos/recepcionados.php";
    }

    public function cancelarRecepcion(){
        if (isset($_POST['codRecepcion'])){
            $this->recepcionModel->setCodRecepcion($_POST['codRecepcion']);
            $this->recepcionModel->cancelarRecepcion();

            $this->redirect();
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