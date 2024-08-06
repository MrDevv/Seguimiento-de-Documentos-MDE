<?php
require_once "models/Documento.php";
require_once "models/Area.php";
require_once "models/Usuario.php";
require_once "models/UsuarioArea.php";

class ReportesController{

    private Documento $documentoModel;
    private Area $areaModel;
    private Usuario $usuarioModel;
    private UsuarioArea $usuarioAreaModel;

    public function __construct(){
        $this->documentoModel = new Documento();
        $this->areaModel = new Area();
        $this->usuarioAreaModel = new UsuarioArea();
    }

    public function docUsuario(){
        $response = [];

        $numDocumento = null ;
        $codUsuario = null;

        if ($_SESSION['user']['rol'] == 'administrador'){
            if (isset($_GET['usuario']) && isset($_GET['numDocumento']) && $_GET['usuario']!= 0){
                $codUsuario = $_GET['usuario'];
                $numDocumento = $_GET['numDocumento'];
            }else if(isset($_GET['usuario']) && isset($_GET['numDocumento']) && $_GET['usuario']== 0){
                $numDocumento = $_GET['numDocumento'];
            }
        }else if($_SESSION['user']['rol'] == 'usuario'){
            $codUsuario = $_SESSION['user']['codUsuarioArea'];
            if(isset($_GET['numDocumento'])){
                $numDocumento = $_GET['numDocumento'];
            }
        }

        $usuarios = $this->usuarioAreaModel->obtenerUsuariosPorArea();

        if($codUsuario && $numDocumento) {
            $response = $this->documentoModel->reportesPorUsuario(null, $numDocumento,(int) $codUsuario);
        } else if ($numDocumento){
            $response = $this->documentoModel->reportesPorUsuario(null, $numDocumento, null);
        }else if ($codUsuario){
            $response = $this->documentoModel->reportesPorUsuario(null, null, $codUsuario);
        }else{
            $response = $this->documentoModel->reportesPorUsuario();
        }

        require_once "views/reportes/documentosPorUsuario.php";
    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "reportes";
    }

    public function redirect(){
        echo '<script type="text/javascript">
        window.location.href = "docAreas";
        </script>';
    }
}