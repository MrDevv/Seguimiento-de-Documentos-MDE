<?php

class Indicacion{
    private int $codIndicacion;
    private string $descripcion;

    public function getCodIndicacion(): int{
        return $this->codIndicacion;
    }

    public function setCodIndicacion(int $codIndicacion): void{
        $this->codIndicacion = $codIndicacion;
    }

    public function getDescripcion(): string{
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void{
        $this->descripcion = $descripcion;
    }

    public function listarIndicaciones($page = 1, $registrosPorPagina = 10){
        $sql = "EXEC sp_listarIndicaciones :page, :registrosPorPagina";

        $stmt = DataBase::connect()->prepare($sql);

        $stmt->bindParam('page', $page, PDO::PARAM_INT);
        $stmt->bindParam('registrosPorPagina', $registrosPorPagina, PDO::PARAM_INT);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function registrarIndicacion(){
        $sql = "INSERT INTO Indicacion(descripcion) values(:descripcion)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam("descripcion", $this->descripcion, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Indicación registrada',
                'action' => 'registrar',
                'module' => 'indicacion',
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar la Indicación',
                'action' => 'registrar',
                'module' => 'indicacion',
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerTotalIndicacionesRegistradas(){
        $sql = "SELECT COUNT(codIndicacion) 'total' FROM Indicacion";

        $stmt = DataBase::connect()->prepare($sql);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function existeIndicacion(){
        $sql= "SELECT * FROM Indicacion WHERE descripcion = :descripcion";

        try{
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam("descripcion", $this->descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'indicacion encontrada',
                    'action' => 'buscar',
                    'module' => 'indicacion',
                    'data' => [],
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'indicacion',
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

    public function actualizarIndicacion(){
        $sql = "UPDATE Indicacion SET descripcion = :descripcion WHERE codIndicacion = :codIndicacion";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam("descripcion", $this->descripcion, PDO::PARAM_STR);
            $stmt->bindParam("codIndicacion", $this->codIndicacion, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Indicación actualizada',
                'action' => 'actualizar',
                'module' => 'indicacion',
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar la indicación',
                'action' => 'actualizar',
                'module' => 'indicacion',
                'info' => $e->getMessage()
            ];
        }
    }
}