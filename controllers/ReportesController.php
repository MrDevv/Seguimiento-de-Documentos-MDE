<?php
require_once "models/Documento.php";
require_once "models/Area.php";

class ReportesController{

    private Documento $documentoModel;
    private Area $areaModel;

    public function __construct(){
        $this->documentoModel = new Documento();
        $this->areaModel = new Area();
    }

    public function docAreas(){
        $response = [];

        $codArea = null;
        $numDocumento = null;

        if ($_SESSION['user']['rol'] == 'administrador'){
            if (isset($_GET['area']) && isset($_GET['numDocumento']) && $_GET['area']!= 0){
                $codArea = $_GET['area'];
                $numDocumento = $_GET['numDocumento'];
            }else if(isset($_GET['area']) && isset($_GET['numDocumento']) && $_GET['area']== 0){
                $numDocumento = $_GET['numDocumento'];
            }else{
                $codArea = null;
                $numDocumento = null;
            }
        }else{
            $codArea = $_SESSION['user']['codArea'];
            $numDocumento = null;
        }

        $areas = $this->areaModel->listarArea();

        if($codArea && $numDocumento) {
            $response = $this->documentoModel->reportesPorArea((int)$codArea, $numDocumento);
        } else if ($codArea){
            $response = $this->documentoModel->reportesPorArea((int) $codArea, null);
        } else if ($numDocumento){
            $response = $this->documentoModel->reportesPorArea(null, $numDocumento);
        }else{
            $response = $this->documentoModel->reportesPorArea();
        }

        require_once "views/reportes/documentosPorArea.php";
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