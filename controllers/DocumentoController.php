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