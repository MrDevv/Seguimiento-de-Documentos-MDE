<?php

class AdministradoController{

    public function registro(){
        require_once "views/administrado/registro.php";
    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "administrado";
    }
}