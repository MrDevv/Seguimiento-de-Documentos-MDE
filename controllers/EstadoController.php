<?php

require_once 'models/Estado.php';

class EstadoController{

    public function getIdEstadoActivo(){
        return Estado::getIdEstadoActivo();
    }

    public function getIdEstadoInactivo(){
        return Estado::getIdEstadoInactivo();
    }

    public function getIdEstadoNuevo(){
        return Estado::getIdEstadoNuevo();
    }

    public function listarEstadosHabilitadoInhabilitado(){
        return Estado::listarEstadosHabilitadoInhabilitado();
    }
}