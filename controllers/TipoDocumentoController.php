<?php
require_once "models/TipoDocumento.php";
class TipoDocumentoController{
    function crear(){
        require_once "views/tipoDocumento/registrarTipoDeDocumento.php";
    }

    function editar(){
        if (isset($_GET["doc"])){
            $codTipoDocumento = $_GET['doc'];

            var_dump($codTipoDocumento);
            require_once "views/tipoDocumento/editarTipoDocumento.php";
        }else{
//            Redirecciona a la vista de listado
            $this->redirect();
        }


    }

    function listar(){

        $tipoDocumentoObj = new TipoDocumento();
        $listadoTipoDocumentos = $tipoDocumentoObj->listarTipoDocumentos();

//        var_dump($listadoTipoDocumentos);

        require_once "views/tipoDocumento/listarTipoDocumentos.php";


    }

    function registrar(){
        $_SESSION["registro"] = "pendiente";

        if (isset($_POST)){
            $tipoDocumento = isset($_POST['tipoDocumento']) ? $_POST['tipoDocumento'] : false;

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