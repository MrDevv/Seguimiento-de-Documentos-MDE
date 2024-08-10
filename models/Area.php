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

    public function listarArea($page = 1, $registrosPorPagina = 10){
        $sql = "sp_listarAreas :page, :registrosPorPagina;";

        $stmt = DataBase::connect()->prepare($sql);

        $stmt->bindParam('page', $page, PDO::PARAM_INT);
        $stmt->bindParam('registrosPorPagina', $registrosPorPagina, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTotalAreasRegistradas(){
        $sql = "SELECT count(codArea) 'total' FROM Area";

        $stmt = DataBase::connect()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function existeArea(){
        $sql= "SELECT * FROM Area WHERE descripcion = :descripcion";

        try{
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam("descripcion", $this->descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'area encontrada',
                    'action' => 'buscar',
                    'module' => 'area',
                    'data' => [],
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'area',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de verificar si el area existe',
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

    function toCamelCase($str) {
        // Convertir todo el string a minúsculas
        $str = strtolower($str);

        // Eliminar caracteres no alfanuméricos y dividir por espacios
        $str = preg_replace('/[^a-z0-9\s]/', '', $str);
        $words = explode(' ', $str);

        // Capitalizar cada palabra excepto la primera
        $camelCase = array_shift($words);
        foreach ($words as $word) {
            $camelCase .= ucfirst($word);
        }

        return $camelCase;
    }

}