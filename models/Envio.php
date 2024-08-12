<?php

require_once 'Documento.php';
require_once 'Estado.php';

class Envio{
    private int $codEnvio;
    private string $fechaEnvio;
    private string $horaEnvio;
    private int $folios;
    private string $observaciones;
    private int $codEstado;
    private int $codMovimiento;
    private string $numDocumento;
    private int $codUsuarioAreaEnvio;
    private int $codUsuarioAreaDestino;

    public function getCodEnvio(): int{
        return $this->codEnvio;
    }

    public function setCodEnvio(int $codEnvio): void{
        $this->codEnvio = $codEnvio;
    }

    public function getFechaEnvio(): string{
        return $this->fechaEnvio;
    }

    public function setFechaEnvio(string $fechaEnvio): void{
        $this->fechaEnvio = $fechaEnvio;
    }

    public function getHoraEnvio(): string{
        return $this->horaEnvio;
    }

    public function setHoraEnvio(string $horaEnvio): void{
        $this->horaEnvio = $horaEnvio;
    }

    public function getFolios(): int{
        return $this->folios;
    }

    public function setFolios(int $folios): void{
        $this->folios = $folios;
    }

    public function getObservaciones(): string{
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): void{
        $this->observaciones = $observaciones;
    }

    public function getCodEstado(): int{
        return $this->codEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

    public function getCodMovimiento(): int{
        return $this->codMovimiento;
    }

    public function setCodMovimiento(int $codMovimiento): void{
        $this->codMovimiento = $codMovimiento;
    }

    public function getNumDocumento(): string{
        return $this->numDocumento;
    }

    public function setNumDocumento(string $numDocumento): void{
        $this->numDocumento = $numDocumento;
    }

    public function getCodUsuarioAreaEnvio(): int{
        return $this->codUsuarioAreaEnvio;
    }

    public function setCodUsuarioAreaEnvio(int $codUsuarioAreaEnvio): void{
        $this->codUsuarioAreaEnvio = $codUsuarioAreaEnvio;
    }

    public function getCodUsuarioAreaDestino(): int{
        return $this->codUsuarioAreaDestino;
    }

    public function setCodUsuarioAreaDestino(int $codUsuarioAreaDestino): void{
        $this->codUsuarioAreaDestino = $codUsuarioAreaDestino;
    }

    public function registrarEnvio(int $codRecepcion = null, string $numDocumento, int $folios, int $codMovimiento,
                                   string $observacion = null, int $codUsuarioAreaDestino, int $codUsuarioAreaEnvio, string $fechaEnvio,
                                   string $horaEnvio){
        $sql = "EXEC sp_registrarEnvio :codRecepcion, :numDocumento, :folios, :codMovimiento, :observacion, :codUsuarioAreaDestino, :codUsuarioAreaEnvio, :fechaEnvio, :horaEnvio";

        try {
            $db = DataBase::connect();
            $stmt = $db->prepare($sql);

            $stmt->bindParam('codRecepcion', $codRecepcion, PDO::PARAM_INT);
            $stmt->bindParam('numDocumento', $numDocumento, PDO::PARAM_STR);
            $stmt->bindParam('folios', $folios, PDO::PARAM_INT);
            $stmt->bindParam('codMovimiento', $codMovimiento, PDO::PARAM_INT);
            $stmt->bindParam('observacion', $observacion, PDO::PARAM_STR);
            $stmt->bindParam('codUsuarioAreaDestino', $codUsuarioAreaDestino, PDO::PARAM_INT);
            $stmt->bindParam('codUsuarioAreaEnvio', $codUsuarioAreaEnvio, PDO::PARAM_INT);
            $stmt->bindParam('fechaEnvio', $fechaEnvio, PDO::PARAM_STR);
            $stmt->bindParam('horaEnvio', $horaEnvio, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => '¡Documento enviado!',
                'action' => 'enviar',
                'module' => 'documento',
                'data' => [],
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de enviar el documento!',
                'action' => 'enviar',
                'module' => 'documento',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerTotalDocumentosEnviados(int $codUsuarioArea, int $codArea = null, $pagina = 1, $registroPorPagina = 10){
        $sql =  "EXEC sp_totalDocumentosEnviados :codUsuarioArea, :codArea";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codUsuarioArea', $codUsuarioArea, PDO::PARAM_INT);
            $stmt->bindParam('codArea', $codArea, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'message' => 'se obtuvo el total de documentos enviados',
                'action' => 'listar',
                'module' => 'documento',
                'data' => $results,
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de obtener el total de documentos enviados!',
                'action' => 'listar',
                'module' => 'recepcion',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }


    public function obtenerDocumentosEnviados(int $codUsuarioEnvio, int $codArea = null, $pagina = 1, $registroPorPagina = 10){
        $sql = "EXEC sp_listarDocumentosEnviados :codUsuarioEnvio, :codArea, :pagina, :registroPorPagina";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codUsuarioEnvio', $codUsuarioEnvio, PDO::PARAM_INT);
            $stmt->bindParam('codArea', $codArea, PDO::PARAM_INT);
            $stmt->bindParam('pagina', $pagina, PDO::PARAM_INT);
            $stmt->bindParam('registroPorPagina', $registroPorPagina, PDO::PARAM_INT);

            $stmt->execute();

            $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'message' => '¡Se obtuvo correctamente los documentos enviados!',
                'action' => 'listar',
                'module' => 'envio',
                'data' => $response,
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de listar los documentos enviados!',
                'action' => 'recepcionar',
                'module' => 'documento',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerDetalleEnvio(){
        $sql = "{CALL sp_verDetalleEnvio(:codEnvio)}";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codEnvio', $this->codEnvio, PDO::PARAM_INT);

            $stmt->execute();

            $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'message' => '¡Se obtuvo correctamente el detalle del envio!',
                'action' => 'buscar',
                'module' => 'envio',
                'data' => $response,
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de obtener el detalle del envio!',
                'action' => 'buscar',
                'module' => 'envio',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function cancelarEnvio(){
        $sql = "{CALL sp_cancelarEnvio(:codEnvio)}";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codEnvio', $this->codEnvio, PDO::PARAM_INT);
            $stmt->execute();

            return [
                'status' => 'success',
                'message' => '¡Se canceló el envio!',
                'action' => 'eliminar',
                'module' => 'envio',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => '¡Ocurrio un error al momento de cancelar el envio!',
                'action' => 'eliminar',
                'module' => 'envio',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }
}