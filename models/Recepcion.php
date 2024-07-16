<?php

class Recepcion{
    private int $codRecepcion;
    private int $codEnvio;
    private string $fechaRecepcion;
    private string $horaRecepcion;
    private int $codUsuarioRecepcion;
    private int $codEstado;

    public function getCodRecepcion(): int{
        return $this->codRecepcion;
    }

    public function setCodRecepcion(int $codRecepcion): void{
        $this->codRecepcion = $codRecepcion;
    }

    public function getCodEnvio(): int{
        return $this->codEnvio;
    }

    public function setCodEnvio(int $codEnvio): void{
        $this->codEnvio = $codEnvio;
    }

    public function getFechaRecepcion(): string{
        return $this->fechaRecepcion;
    }

    public function setFechaRecepcion(string $fechaRecepcion): void{
        $this->fechaRecepcion = $fechaRecepcion;
    }

    public function getHoraRecepcion(): string{
        return $this->horaRecepcion;
    }

    public function setHoraRecepcion(string $horaRecepcion): void{
        $this->horaRecepcion = $horaRecepcion;
    }

    public function getCodUsuarioRecepcion(): int{
        return $this->codUsuarioRecepcion;
    }

    public function setCodUsuarioRecepcion(int $codUsuarioRecepcion): void{
        $this->codUsuarioRecepcion = $codUsuarioRecepcion;
    }

    public function getCodEstado(): int{
        return $this->codEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

    public function registrarRecepcion(){
        $sql = "insert into Recepcion(codEnvio, codEstado, codUsuarioRecepcion) ".
                "values(:codEnvio, :codEstado, :codUsuarioRecepcion)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codEnvio', $this->codEnvio, PDO::PARAM_INT);
            $stmt->bindParam('codEstado', $this->codEstado, PDO::PARAM_INT);
            $stmt->bindParam('codUsuarioRecepcion', $this->codUsuarioRecepcion, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => '¡Se registro la recepcion!',
                'action' => 'recepcionar',
                'module' => 'documento',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de registrar la recepcionar del documento!',
                'action' => 'recepcionar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }

    }

    public function getDocumentosPendientesRecepcion(int $codUsuarioArea){

        $sql = "{CALL sp_listarDocumentosPendientesRecepcion(:codUsuarioArea)}";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codUsuarioArea', $codUsuarioArea, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0){
                return [
                    'status' => 'success',
                    'message' => '¡Documentos encontrados!',
                    'action' => 'buscar',
                    'module' => 'documento',
                    'data' => $results,
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'documento',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de buscar los documento pendientes de recepcion!',
                'action' => 'buscar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }
    public function listarDocumentosRecepcionados(int $codUsuarioRecepcion){
        $sql = "{CALL sp_listarDocumentosRecepcionados(:codUsuarioArea)}";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codUsuarioArea', $codUsuarioRecepcion, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0){
                return [
                    'status' => 'success',
                    'message' => '¡Documentos encontrados!',
                    'action' => 'buscar',
                    'module' => 'documento',
                    'data' => $results,
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'documento',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de buscar los documentos recepcionados!',
                'action' => 'buscar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function existeRecepcion(){
        $sql = "select * from Recepcion where codRecepcion = :codRecepcion";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam(":codRecepcion", $this->codRecepcion, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0){
                return [
                    'status' => 'success',
                    'message' => '¡Recepcion encontrada!',
                    'action' => 'buscar',
                    'module' => 'documento',
                    'data' => $results,
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'documento',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de buscar la recepción',
                'action' => 'buscar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function cambiarEstadoRecepcion(){
        $sql = "update Recepcion set codEstado = :codEstado, horaRecepcion = :horaRecepcion, fechaRecepcion = :fechaRecepcion where codRecepcion = :codRecepcion";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codEstado', $this->codEstado, PDO::PARAM_INT);
            $stmt->bindParam('codRecepcion', $this->codRecepcion, PDO::PARAM_INT);
            $stmt->bindParam('fechaRecepcion', $this->fechaRecepcion, PDO::PARAM_STR);
            $stmt->bindParam('horaRecepcion', $this->horaRecepcion, PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'message' => '¡Se repcecionó el documento!',
                    'action' => 'listar',
                    'module' => 'documento',
                    'data' => [],
                    'info' => ''
                ];
            } else {
                return [
                    'status' => 'failed',
                    'message' => '¡No se pudo cambiar el estado de la recepcion!',
                    'action' => 'listar',
                    'module' => 'documento',
                    'data' => [],
                    'info' => ''
                ];
            }


        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de cambiar el estado de la recepcion',
                'action' => 'listar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function cancelarRecepcion(){
        $sql = "{CALL sp_cancelarRecepcion(:codRecepcion)}";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codRecepcion', $this->codRecepcion, PDO::PARAM_INT);
            $stmt->execute();

            return [
                'status' => 'success',
                'message' => '¡Se canceló la recepcion!',
                'action' => 'actualizar',
                'module' => 'recepcion',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de cancelar la recepción!',
                'action' => 'actualizar',
                'module' => 'recepcion',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

}