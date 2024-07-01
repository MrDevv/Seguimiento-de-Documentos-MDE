<?php

class Estado {
    private $codEstado;
    private $descripcion;

    public function getCodEstado(){
        return $this->codEstado;
    }

    public function setCodEstado($codEstado){
        $this->getCodEstado = $codEstado;
    }

    public function getDescripcion(){
        return $this->Descripcion;
    }

    public function setDescripcion($descripcion){
        $this->getDescripcion = $descripcion;
    }

    public function listarEstadosHabilitadoInhabilitado(){
        $sql = "select *
                from Estado e where descripcion = 'Habilitado' OR descripcion = 'Deshabilitado'";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;

    }

}