<?php

class TipoDocumento{
    private $codTipoDocumento;
    private $descripcion;

    public function __construct(){
    }

    public function getCodTipoDocumento()
    {
        return $this->codTipoDocumento;
    }

    public function setCodTipoDocumento($codTipoDocumento)
    {
        $this->codTipoDocumento = $codTipoDocumento;
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
                'message' => '¡Tipo documento registrado!',
                'action' => 'registrar',
                'module' => 'tipoDocumento'
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el tipo de documento',
                'action' => 'registrar',
                'module' => 'tipoDocumento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function listarTipoDocumentos(){
        $sql = "SELECT * FROM TipoDocumento";

        $stmt = DataBase::connect()->query($sql);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function buscarTipoDocumento(){
        $sql = "SELECT * FROM TipoDocumento WHERE CodTipoDocumento = :codTipoDocumento";
        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":codTipoDocumento", $this->codTipoDocumento, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (sizeof($results) == 0){
                return [
                    'status' => 'not found',
                    'message' => 'No existe un tipo documento con este código',
                    'action' => 'buscar',
                    'module' => 'tipoDocumento'
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡Se encontró el tipo documento!',
                'action' => 'buscar',
                'module' => 'tipoDocumento',
                'data' => $results
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el tipo de documento',
                'action' => 'buscar',
                'module' => 'tipoDocumento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarTipoDocumento(){
        $sql = "UPDATE TipoDocumento SET descripcion = :descripcion WHERE CodTipoDocumento = :codTipoDocumento";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":codTipoDocumento", $this->codTipoDocumento, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Tipo documento actualizado',
                'action' => 'actualizar',
                'module' => 'tipoDocumento'
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el tipo de documento',
                'action' => 'actualizar',
                'module' => 'tipoDocumento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function existeTipoDocumento($codTipoDocumento){
        $sql = "SELECT * FROM TipoDocumento WHERE CodTipoDocumento = :codTipoDocumento";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);

            $stmt->execute();


            return [
                'status' => 'success',
                'message' => 'Tipo documento registrado',
                'module' => 'tipoDocumento',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el tipo de documento',
                'action' => '',
                'module' => 'tipoDocumento',
                'info' => $e->getMessage()
            ];
        }
    }
}