<?php

require_once "models/Envio.php";
require_once "models/Usuario.php";
require_once "models/Area.php";
require_once "models/Estado.php";

require_once "models/UsuarioArea.php";
require_once "MovimientoController.php";
require_once "DocumentoController.php";

class EnvioController{
    private Envio $envioModel;
//    private Documento $documentoModel;
//    private UsuarioArea $usuarioAreaOrigenModel;
//    private UsuarioArea $usuarioAreaDestinoModel;
//    private Usuario $usuarioOrigenModel;
//    private Usuario $usuarioDestinoModel;
//    private Area $areaOrigenModel;
//    private Area $areaDestinoModel;
    private Estado $estadoModel;
    private Area $areaModel;

    private MovimientoController $movimientoController;
    private DocumentoController $documentoController;


    public function __construct(){
        $this->envioModel = new Envio();
        $this->areaModel = new Area();
        $this->movimientoController = new MovimientoController();
        $this->documentoController = new DocumentoController();

//        $this->documentoModel = new Documento();
//        $this->usuarioAreaOrigenModel = new UsuarioArea();
//        $this->usuarioAreaDestinoModel = new UsuarioArea();
//        $this->usuarioOrigenModel = new Usuario();
//        $this->usuarioDestinoModel = new Usuario();
//        $this->areaOrigenModel = new Area();
//        $this->areaDestinoModel = new Area();
//        $this->estadoModel = new Estado();
    }
    public function pendientesDeRecepcion(){
        $response = $this->envioModel->getDocumentosPendientesRecepcion(2, 2);

        if ($response['status'] == 'failed'){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }

//        var_dump($response);

        require_once "views/documentos/pendientesDeRecepcion.php";
    }

    public function recepcionados(){
        $envioObj = new Envio();
        $codEstadoEnvio = (int) Estado::getIdEstadoInactivo();

        $response = $envioObj->getDocumentosRecepcionados(2, 2, $codEstadoEnvio);

//        var_dump($response);

        require_once "views/documentos/recepcionados.php";
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


                $sql = "select ua.codUsuarioArea, concat(p.nombres, p.apellidos) 'usuario' 
                        from UsuarioArea ua 
                        inner join Area a on ua.codArea = a.codArea
                        inner join Usuario u on ua.codUsuario = u.codUsuario
                        inner join Persona p on u.codPersona = p.codPersona 
                        where a.codArea = :codArea and ua.codUsuarioArea != 4";

                $stmt = DataBase::connect()->prepare($sql);

                $stmt->bindParam('codArea', $area, PDO::PARAM_INT);

                 $stmt->execute();

                 $usuarios =$stmt->fetchAll(PDO::FETCH_ASSOC);

                 if (count($usuarios) == 0){
                     $_SESSION['response'] = [
                         'status' => 'failed',
                         'message' => 'No existen usuarios en el area seleccionada',
                         'action' => '',
                         'module' => 'documento'
                     ];
                     require_once "views/modals/alerta.php";
                     exit();
                 }

            require_once "views/documentos/seleccionarUsuarioDestino.php";
        }else{
            $this->goBack();
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
            $this->envioModel->setCodUsuarioAreaEnvio(2);

//            var_dump($this->envioModel);
//            exit();

            $response = $this->envioModel->registrarEnvio();
            $this->documentoController->iniciarSeguimiento($numDocumento);
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
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
}