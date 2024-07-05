<?php

require_once 'models/Estado.php';

class EstadoController{

    public function getIdEstadoActivo(){
        return Estado::getIdEstadoActivo();
    }

    public function listarEstadosHabilitadoInhabilitado(){
        return Estado::listarEstadosHabilitadoInhabilitado();
    }
}