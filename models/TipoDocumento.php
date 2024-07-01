<?php

class TipoDocumento{
    private $codTipoDocumento;
    private $descripcion;

    public function __construct(){
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function guardarTipoDocumento(){

        $sql = "INSERT INTO TipoDocumento(descripcion) values(:descripcion)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Tipo documento registrado',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el tipo de documento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function listarTipoDocumentos(){
        $sql = "SELECT * FROM TipoDocumento";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}