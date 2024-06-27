<?php

require_once "models/TipoDocumento.php";

class TipoDocumentoController{
    function crear(){
        require_once "views/documentos/registrarTipoDeDocumento.php";
    }

    function registrar(){
        $_SESSION["registro"] = "pendiente";

        if (isset($_POST)){
            $tipoDocumento = isset($_POST['tipoDocumento']) ? $_POST['tipoDocumento'] : false;

            if ($tipoDocumento){
                $tipoDocumentoObj = new TipoDocumento($tipoDocumento);

                $result = $tipoDocumentoObj->guardarTipoDocumento();

                if ($result){
                   // require_once "views/modals/registroExitoso.php";
                }else{
                    //require_once "views/modals/registroError.php";
                }

                header('Location:'.base_url."tipoDocumento/crear");
            }
        }
    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "documento";
    }

    public function redirect()
    {
        header('Location:'.base_url."tipoDocumento/crear");
    }
}