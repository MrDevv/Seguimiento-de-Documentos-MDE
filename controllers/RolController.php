<?php

require_once 'models/Rol.php';

class EstadoController{

    public function listarRoles(){
        return Rol::listarRoles();
    }
}