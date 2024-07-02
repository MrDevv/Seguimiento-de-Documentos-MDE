<?php
require_once "models/TipoDocumento.php";
class TipoDocumentoController{
    function crear(){
        require_once "views/tipoDocumento/registrarTipoDeDocumento.php";
    }

    function editar(){
        if (isset($_GET["doc"])){
            $codTipoDocumento = $_GET['doc'];
            $tipoDocumentoDB = $this->buscar($codTipoDocumento);
//            var_dump($tipoDocumentoDB);
            require_once "views/tipoDocumento/editarTipoDocumento.php";
        }else{
//            Redirecciona a la vista de listado
            $this->redirect();
        }
    }

    function buscar($codTipoDocumento){
        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setCodTipoDocumento($codTipoDocumento);

        $response = $tipoDocumento->buscarTipoDocumento();

        if (isset($response['message'])){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }
        return $response;
    }

    public function actualizar(){
        $codTipoDocumento = isset($_POST['codTipoDocumento']) ? (int) $_POST['codTipoDocumento'] : false;
        $tipoDocumento = isset($_POST['tipoDocumento']) ? trim($_POST['tipoDocumento']) : false;

        if (!$codTipoDocumento || !$tipoDocumento){
            $this->redirect();
            exit();
        }

            $tipoDocumentoObj = new TipoDocumento();
            $tipoDocumentoObj->setCodTipoDocumento($codTipoDocumento);
            $tipoDocumentoObj->setDescripcion($tipoDocumento);

            $response = $tipoDocumentoObj->actualizarTipoDocumento();

            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
    }

    function listar(){
        $tipoDocumentoObj = new TipoDocumento();
        $listadoTipoDocumentos = $tipoDocumentoObj->listarTipoDocumentos();

        require_once "views/tipoDocumento/listarTipoDocumentos.php";
    }

    function registrar(){
        if (isset($_POST)){
            $tipoDocumento = isset($_POST['tipoDocumento']) ? trim($_POST['tipoDocumento']) : false;

            if ($tipoDocumento){
                $tipoDocumentoObj = new TipoDocumento();
                $tipoDocumentoObj->setDescripcion($tipoDocumento);
//                $response [status, message, info]
                $response = $tipoDocumentoObj->guardarTipoDocumento();
//                var_dump($response);
                $_SESSION['response'] = $response;
                require_once "views/modals/alerta.php";
            }
        }
    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "tipoDocumento";
    }

    public function redirect()
    {
        echo '<script type="text/javascript">
        window.location.href = "listar";
        </script>';
//        header('Location:'.base_url."tipoDocumento/crear");
    }
}