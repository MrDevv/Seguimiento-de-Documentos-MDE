<?php

class Area {
    private $descripcion;
    private $codArea;

    public function __construct(){

    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getCodArea(){
        return $this->codArea;
    }

    public function setCodArea($codArea){
        $this->codArea = $codArea;
        
    }

    public function registrarArea(){
        $sql = "INSERT INTO Area(descripcion) values(:descripcion)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Area registrada',
                'action' => 'registrar',
                'module' => 'area',
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el Area',
                'action' => 'registrar',
                'module' => 'area',
                'info' => $e->getMessage()
            ];
        }
    }

    public function listarArea(){
        $sql = "SELECT * FROM Area";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
    public function buscarArea(){
        $sql = "SELECT * FROM Area WHERE CodArea = :codArea";
        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":codArea", $this->codArea, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (sizeof($results) == 0){
                return [
                    'status' => 'not found',
                    'message' => 'No existe una Area con este código',
                    'action' => 'buscar',
                    'module' => 'area',
                    'info' => ''
                ];
            }

            return $results;

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el area',
                'action' => 'buscar',
                'module' => 'area',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarArea(){
        $sql = "UPDATE Area SET descripcion = :descripcion WHERE CodArea = :codArea";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":codArea", $this->codArea, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Area actualizada',
                'action' => 'actualizar',
                'module' => 'area',
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el area',
                'action' => 'actualizar',
                'module' => 'area',
                'info' => $e->getMessage()
            ];
        }
    }


}