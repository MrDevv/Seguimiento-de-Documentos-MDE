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

    public function obtenerTotalDocumentosRecepcionados(int $codUsuarioArea, int $codArea = null){
        $sql =  "EXEC sp_totalDocumentosRecepcionados :codUsuarioArea, :codArea";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codUsuarioArea', $codUsuarioArea, PDO::PARAM_INT);
            $stmt->bindParam('codArea', $codArea, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'message' => 'se obtuvo el total de documentos recepcionados',
                'action' => 'listar',
                'module' => 'documento',
                'data' => $results,
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de obtener el total de documentos recepcionados!',
                'action' => 'listar',
                'module' => 'recepcion',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerTotalDocumentosPendienteRecepcion(int $codUsuarioArea, int $codArea = null){
        $sql =  "EXEC sp_totalDocumentosPendientesRecepcion :codUsuarioArea, :codArea";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codUsuarioArea', $codUsuarioArea, PDO::PARAM_INT);
            $stmt->bindParam('codArea', $codArea, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'message' => 'se obtuvo el total de documentos',
                'action' => 'listar',
                'module' => 'documento',
                'data' => $results,
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de obtener el total de documentos pendientes de recepcion!',
                'action' => 'listar',
                'module' => 'recepcion',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function getDocumentosPendientesRecepcion(int $codUsuarioArea, int $codArea = null, $pagina = 1, $registroPorPagina = 10){

        $sql = "EXEC sp_listarDocumentosPendientesRecepcion :codUsuarioArea, :codArea, :pagina, :registroPorPagina ";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codUsuarioArea', $codUsuarioArea, PDO::PARAM_INT);
            $stmt->bindParam('codArea', $codArea, PDO::PARAM_INT);
            $stmt->bindParam('pagina', $pagina, PDO::PARAM_INT);
            $stmt->bindParam('registroPorPagina', $registroPorPagina, PDO::PARAM_INT);

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

    public function listarDocumentosRecepcionados(int $codUsuarioRecepcion, int $codArea = null, $pagina = 1, $registroPorPagina = 10){
        $sql = "EXEC sp_listarDocumentosRecepcionados :codUsuarioArea, :codArea, :pagina, :registroPorPagina";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codUsuarioArea', $codUsuarioRecepcion, PDO::PARAM_INT);
            $stmt->bindParam('codArea', $codArea, PDO::PARAM_INT);
            $stmt->bindParam('pagina', $pagina, PDO::PARAM_INT);
            $stmt->bindParam('registroPorPagina', $registroPorPagina, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0){
                return [
                    'status' => 'success',
                    'message' => '¡Documentos recepcionados encontrados!',
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

    public function listarDocumentosRecepcionadosReporte(int $codUsuarioRecepcion, $pagina = 1, $registroPorPagina = 10, $fechaInicio = null, $fechaFin = null, $numDocumento = ''){
        $sql = "EXEC sp_reporteDocumentosRecepcionados :codUsuarioArea, :pagina, :registroPorPagina, :fechaInicio, :fechaFin, :numDocumento";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codUsuarioArea', $codUsuarioRecepcion, PDO::PARAM_INT);
            $stmt->bindParam('pagina', $pagina, PDO::PARAM_INT);
            $stmt->bindParam('registroPorPagina', $registroPorPagina, PDO::PARAM_INT);
            $stmt->bindParam('fechaInicio', $fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam('fechaFin', $fechaFin, PDO::PARAM_STR);
            $stmt->bindParam('numDocumento', $numDocumento, PDO::PARAM_STR);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0){
                return [
                    'status' => 'success',
                    'message' => '¡Reporte de documentos recepcionados encontrados!',
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

    public function obtenerTotalDocumentosPendienteRecepcionReporte(int $codUsuarioRecepcion, $fechaInicio = null, $fechaFin = null, $numDocumento = ''){
        $sql =  "EXEC sp_totalDocumentosRecepcionadosReporte :codUsuarioArea, :fechaInicio, :fechaFin, :numDocumento";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codUsuarioArea', $codUsuarioRecepcion, PDO::PARAM_INT);
            $stmt->bindParam('fechaInicio', $fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam('fechaFin', $fechaFin, PDO::PARAM_STR);
            $stmt->bindParam('numDocumento', $numDocumento, PDO::PARAM_STR);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'message' => 'se obtuvo el total de documentos recepcionados reporte',
                'action' => 'listar',
                'module' => 'documento',
                'data' => $results,
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de obtener el total de documentos recepcionados reporte!',
                'action' => 'listar',
                'module' => 'recepcion',
                'data' => [],
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

    public function confirmarRecepcion(){
        $sql = "EXEC sp_confirmarRecepcion :codRecepcion, :horaRecepcion, :fechaRecepcion";

        try {
            $stmt = DataBase::connect()->prepare($sql);

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