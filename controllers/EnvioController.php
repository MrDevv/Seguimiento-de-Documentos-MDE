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
    private MovimientoController $movimientoController;
    private DocumentoController $documentoController;


    public function __construct(){
        $this->envioModel = new Envio();
        $this->areaModel = new Area();
        $this->movimientoController = new MovimientoController();
        $this->documentoController = new DocumentoController();
        $this->recepcionModel = new Recepcion();
    }

    public function nuevoEnvio(){
        if (isset($_GET["doc"])){
            $documentoDB = new Documento();

            $numDocumento = $_GET["doc"];
            $response = $this->documentoController->buscar($numDocumento);

            $movimientos = $this->movimientoController->listarMovimientos();
            $areas = $this->areaModel->listarArea();
            $fechaActual = $this->obtenerFechaActual();
            $horaActual = $this->obtenerHoraActual();

            $codRecepcion = isset($_GET["recep"]) ? ($_GET["recep"]) : false;
            require_once "views/documentos/registrarEnvio.php";
        }else{
            $this->goBack();
        }
    }

    public function usuarioDestino(){
        if (isset($_POST['area'])){
                $numDocumento = isset($_POST['nroDocumento']) ? $_POST['nroDocumento'] : false;
                $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : false;
                $folios = isset($_POST['folios']) ? $_POST['folios'] : false;
                $movimiento = isset($_POST['movimiento']) ? $_POST['movimiento'] : false;
                $area = isset($_POST['area']) ? $_POST['area'] : false;
                $observacion = isset($_POST['observacion']) ? $_POST['observacion'] : false;
                $codRecepcion = isset($_POST['codRecepcion']) ? $_POST['codRecepcion'] : false;

                $response = $this->obtenerUsuariosPorArea($area, (int) $_SESSION['user']['codUsuario']);

                if (count($response['data']) == 0){
                    $response['status'] = 'warning';
                    $response['module'] = 'documento';
                    $_SESSION['response'] = $response;
                    require_once "views/modals/alerta.php";
                    exit();
                }

                require_once "views/documentos/seleccionarUsuarioDestino.php";
        }else{
            $this->goBack();
        }
    }

//    colocar funcion en la case de UsuarioArea
    public function obtenerUsuariosPorArea(int $codArea, int $codUsuarioArea){
        $sql = "select ua.codUsuarioArea, concat(p.nombres, ' ' ,p.apellidos) 'usuario' 
                        from UsuarioArea ua 
                        inner join Area a on ua.codArea = a.codArea
                        inner join Usuario u on ua.codUsuario = u.codUsuario
                        inner join Persona p on u.codPersona = p.codPersona 
                        where a.codArea = :codArea and ua.codUsuarioArea != :codUsuarioArea ";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codArea', $codArea, PDO::PARAM_INT);
            $stmt->bindParam('codUsuarioArea', $codUsuarioArea, PDO::PARAM_INT);

            $stmt->execute();

            $results =$stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results)>0){
                return [
                    'status' => 'success',
                    'message' => 'listado de usuarios correcto',
                    'action' => 'listar',
                    'module' => 'usuarioArea',
                    'data' => $results,
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => 'no se encontraron usuarios en esta area',
                'action' => 'listar',
                'module' => 'usuarioArea',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de listar los usuarios del area',
                'action' => 'listar',
                'module' => 'usuarioArea',
                'info' => $e->getMessage()
            ];
        }
    }

    public function enviar(){
            $numDocumento = isset($_POST['nroDocumento']) ? $_POST['nroDocumento'] : false;
            $folios = isset($_POST['folios']) ? $_POST['folios'] : false;
            $movimiento = isset($_POST['movimiento']) ? $_POST['movimiento'] : false;
            $observacion = isset($_POST['observacion']) ? $_POST['observacion'] : false;
            $usuarioAreaDestino = isset($_POST['usuarioAreaDestino']) ? $_POST['usuarioAreaDestino'] : false;

            $this->envioModel->setFechaEnvio($this->obtenerFechaActual());
            $this->envioModel->setHoraEnvio($this->obtenerHoraActual());
            $this->envioModel->setFolios($folios);
            $this->envioModel->setObservaciones($observacion);
            $this->envioModel->setCodEstado(Estado::getIdEstadoActivo());
            $this->envioModel->setCodMovimiento($movimiento);
            $this->envioModel->setNumDocumento($numDocumento);
            $this->envioModel->setCodUsuarioAreaDestino($usuarioAreaDestino);
            $this->envioModel->setCodUsuarioAreaEnvio((int) $_SESSION['user']['codUsuario']);

            $response = $this->envioModel->registrarEnvio();
            $this->documentoController->iniciarSeguimiento($numDocumento);

        $codRecepcion = isset($_POST['codRecepcion']) ? $_POST['codRecepcion'] : false;

        if ($codRecepcion){
            $this->recepcionModel->setCodRecepcion((int) $codRecepcion);
            $this->recepcionModel->setCodEstado(Estado::getIdEstadoEviado());
            $this->recepcionModel->setFechaRecepcion($this->obtenerFechaActual());
            $this->recepcionModel->setHoraRecepcion($this->obtenerHoraActual());
            $this->recepcionModel->cambiarEstadoRecepcion();
        }

        $this->recepcionModel->setCodEnvio((int) $response['data']['id']);
        $this->recepcionModel->setCodEstado(Estado::getIdEstadoInactivo());
        $this->recepcionModel->setCodUsuarioRecepcion($usuarioAreaDestino);
        $response = $this->recepcionModel->registrarRecepcion();

            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
    }

    // accion para obtener los documentos enviados
    public function enviados(){
        $this->envioModel->setCodEstado(Estado::getIdEstadoInactivo());
        $this->envioModel->setCodUsuarioAreaEnvio((int) $_SESSION['user']['codUsuario']);
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