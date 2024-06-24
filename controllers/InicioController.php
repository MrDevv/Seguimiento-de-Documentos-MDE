<?php

class InicioController{

    public function index(){
        require_once 'views/inicio.php';
    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "inicio";
    }
}
