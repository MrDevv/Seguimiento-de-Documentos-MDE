<?php

class TipoDocumento{
    private $codTipoDocumento;
    private $descripcion;

    public function __construct($descripcion){
        $this->descripcion = $descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function guardarTipoDocumento(){

        $sql = "INSERT INTO TipoDocumento(descripcion) values(':descripcion')";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);

            $stmt->execute();

            return true;
        }catch (PDOException $e){
            return false;
        }
    }
}