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

    public function registrarEnvio(){
        $sql = "insert into Envio (fechaEnvio, horaEnvio, folios, observaciones, codEstado, codMovimiento, NumDocumento, codUsuarioEnvio, codUsuarioDestino) ".
                "values (:fechaEnvio, :horaEnvio, :folios, :observaciones, :codEstado, :codMovimiento, :numDocumento, :codUsuarioEnvio, :codUsuarioDestino)";

        try {
            $db = DataBase::connect();
            $stmt = $db->prepare($sql);

            $stmt->bindParam('fechaEnvio', $this->fechaEnvio, PDO::PARAM_STR);
            $stmt->bindParam('horaEnvio', $this->horaEnvio, PDO::PARAM_STR);
            $stmt->bindParam('folios', $this->folios, PDO::PARAM_INT);
            $stmt->bindParam('observaciones', $this->observaciones, PDO::PARAM_STR);
            $stmt->bindParam('codEstado', $this->codEstado, PDO::PARAM_INT);
            $stmt->bindParam('codMovimiento', $this->codMovimiento, PDO::PARAM_INT);
            $stmt->bindParam('numDocumento', $this->numDocumento, PDO::PARAM_STR);
            $stmt->bindParam('codUsuarioEnvio', $this->codUsuarioAreaEnvio, PDO::PARAM_INT);
            $stmt->bindParam('codUsuarioDestino', $this->codUsuarioAreaDestino, PDO::PARAM_INT);

            $stmt->execute();

            $lastInsertId = $db->lastInsertId();

            return [
                'status' => 'success',
                'message' => '¡Documento enviado!',
                'action' => 'enviar',
                'module' => 'documento',
                'data' => ['id' => $lastInsertId],
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

    public function obtenerDocumentosEnviados(){
        $sql = "select e.codEnvio, ".
            "LEFT(CONVERT(VARCHAR, e.horaEnvio, 108), 5) AS 'hora envio', ".
            "e.fechaEnvio, ".
            "e.folios, ".
            "e.observaciones, ".
            "d.NumDocumento, ".
            "td.descripcion 'tipo documento', ".
            "CONCAT(pd.nombres, ' ',pd.apellidos) 'usuario destino', ".
            "ad.descripcion 'area destino', ".
            "er.descripcion 'estado recepcion' ".
            "from Recepcion r ".
            "inner join Envio e on r.codEnvio = e.codEnvio ".
            "INNER JOIN Documento d ON e.NumDocumento = d.NumDocumento ".
            "INNER JOIN TipoDocumento td ON d.codTipoDocumento = td.codTipoDocumento ".
            "INNER JOIN UsuarioArea uad ON e.codUsuarioDestino = uad.codUsuario ".
            "INNER JOIN Usuario ud ON uad.codUsuario = ud.codUsuario ".
            "INNER JOIN Persona pd ON ud.codPersona = pd.codPersona ".
            "INNER JOIN Area ad ON uad.codArea = ad.codArea ".
            "INNER JOIN Estado er ON r.codEstado = er.codEstado ".
            "where e.codUsuarioEnvio= :codUsuarioEnvio ".
            "ORDER BY e.fechaEnvio DESC, e.horaEnvio DESC";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codUsuarioEnvio', $this->codUsuarioAreaEnvio, PDO::PARAM_INT);

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