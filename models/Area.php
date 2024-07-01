<?php

class Area {
    private $descripcion;
    private $estado;
    private $codArea;

    public function __construct(){

    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
        
    }

    public function getCodArea(){
        return $this->codArea;
    }

    public function setCodArea($codArea){
        $this->codArea = $codArea;
        
    }

    public function registrarArea(){
        $sql = "INSERT INTO Area(descripcion, codEstado) values(:descripcion, :codEstado)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":codEstado", $this->estado, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Area registrada',
                'action' => 'registrar'
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el Area',
                'action' => 'registrar',
                'info' => $e->getMessage()
            ];
        }
    }

    public function listarArea(){
        $sql = "SELECT a.codArea, a.descripcion, e.descripcion AS estado ". 
                "FROM Area a ".
                "JOIN Estado e ON a.codEstado = e.codEstado;";

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
                    'action' => 'buscar'
                ];
            }

            return $results;

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el area',
                'action' => 'buscar',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarArea(){
        $sql = "UPDATE Area SET descripcion = :descripcion, codEstado = :codEstado WHERE CodArea = :codArea";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":codArea", $this->codArea, PDO::PARAM_INT);
            $stmt->bindParam(":codEstado", $this->estado, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Area actualizada',
                'action' => 'actualizar'
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el area',
                'action' => 'actualizar',
                'info' => $e->getMessage()
            ];
        }
    }


}