<?php

require_once 'models/Estado.php';

class EstadoController{
    private $codEstado;
    private $descripcion;

    public function __construct(){}

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getCodEstado(){
        return $this->codEstado;
    }

    public function setCodEstado($codEstado){
        $this->codEstado = $codEstado;
    }

    public function getIdEstadoActivo(){
        return Estado::getIdEstadoActivo();
    }

    public function listarEstadosHabilitadoInhabilitado(){
        return Estado::listarEstadosHabilitadoInhabilitado();
    }
}