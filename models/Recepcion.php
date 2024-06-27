<?php

class Recepcion{
    private $codRecepcion;
    private $fechaRecepcion;
    private $codAdministrado;
    private $codEstado;

    public function getCodRecepcion(){
        return $this->codRecepcion;
    }

    public function setCodRecepcion($codRecepcion){
        $this->codRecepcion = $codRecepcion;
    }

    public function getFechaRecepcion()
    {
        return $this->fechaRecepcion;
    }

    public function setFechaRecepcion($fechaRecepcion){
        $this->fechaRecepcion = $fechaRecepcion;
    }

    public function getCodAdministrado(){
        return $this->codAdministrado;
    }

    public function setCodAdministrado($codAdministrado){
        $this->codAdministrado = $codAdministrado;
    }

    public function getCodEstado(){
        return $this->codEstado;
    }

    public function setCodEstado($codEstado){
        $this->codEstado = $codEstado;
    }

    public function registrarRecepcion(){
        var_dump($this->codRecepcion);
    }
}