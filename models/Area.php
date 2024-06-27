<?php

class Area {
    private $Descripcion;
    private $Estado;

    public function __construct(){

    }

    public function getDescripcion(){
        return $this->Descripcion;
    }

    public function setDescripcion($Descripcion){
        $this->Descripcion = $Descripcion;
    }

    public function getEstado(){
        return $this->Estado;
    }

    public function setEstado($Estado){
        $this->Estado = $Estado;
        
    }

    public function registrarArea(){
        $sql = "SELECT a.codArea, a.descripcion, e.descripcion AS estado ". 
                "FROM Area a ".
                "JOIN Estado e ON a.codEstado = e.codEstado;";

        $stm = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}