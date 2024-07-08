<?php

class Rol {
    private $codRol;
    private $descripcion;

    public function getCodRol(){
        return $this->codRol;
    }

    public function setCodRol($codRol){
        $this->getCodRol = $codRol;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->getDescripcion = $descripcion;
    }

    public static function listarRoles(){
        $sql = "select * from Rol";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }

}