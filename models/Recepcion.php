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
        $sql = "insert into Recepcion(codEnvio, fechaRecepcion, horaRecepcion, codEstado, codUsuarioRecepcion) ".
                "values(:codEnvio, :fechaRecepcion, :horaRecepcion, :codEstado, :codUsuarioRecepcion)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codEnvio', $this->codEnvio, PDO::PARAM_INT);
            $stmt->bindParam('horaRecepcion', $this->horaRecepcion, PDO::PARAM_STR);
            $stmt->bindParam('fechaRecepcion', $this->fechaRecepcion, PDO::PARAM_STR);
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



}