<?php

class Estado {
    private $codEstado;
    private $descripcion;

    public function getCodEstado(){
        return $this->codEstado;
    }

    public function setCodEstado($codEstado){
        $this->codEstado = $codEstado;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public static function listarEstadosHabilitadoInhabilitado(){
        $sql = "select * from Estado";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }

    public static function getIdEstadoActivo(){
        $sql = "select codEstado from Estado where descripcion = 'a'";

        $stmt = DataBase::connect()->prepare($sql);

        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results['codEstado'];
    }

    public static function getIdEstadoInactivo(){
        $sql = "select codEstado from Estado where descripcion = 'i'";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results['codEstado'];
    }

    public static function getIdEstadoNuevo(){
        $sql = "select codEstado from Estado where descripcion = 'n'";

        $stmt = DataBase::connect()->prepare($sql);

        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results['codEstado'];
    }

    public static function getIdEstadoEviado(){
        $sql = "select codEstado from Estado where descripcion = 'e'";

        $stmt = DataBase::connect()->prepare($sql);

        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results['codEstado'];
    }

}