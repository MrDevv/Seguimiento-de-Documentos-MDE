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

    public static function listarEstadosHabilitadoInhabilitado(){
        $sql = "select * from Estado";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }

    public static function getIdEstadoActivo(){
        $sql = "select codEstado from Estado where descripcion = 1";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results['codEstado'];
    }

    public static function getIdEstadoInactivo(){
        $sql = "select codEstado from Estado where descripcion = 0";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results['codEstado'];
    }

}