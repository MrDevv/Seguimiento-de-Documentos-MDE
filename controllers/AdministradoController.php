<?php
require_once "models/Administrado.php";

class AdministradoController{

    public function crear(){  
        require_once "views/administrado/registro.php";
    }

    public function registroNuevoAdministrado(){
        //$registroNuevoAdministrado = new Administrado();

        //$resultsRegistroAdministrado = $registroNuevoAdministrado->registroNuevoAdministrado();
    }

    

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "administrado";
    }
}