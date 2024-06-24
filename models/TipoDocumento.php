<?php

class TipoDocumento{
    private $codTipoDocumento;
    private $descripcion;

    public function __construct($descripcion){
        $this->descripcion = $descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }
}