<?php

class Documento{
    private $numDocumento;
    private $asunto;
    private $folios;
    private $tipoDocumento;
    private $fechaRegistro;
    private $usuario;
    private $estado;

    public function __construct(){}

    public function getNumDocumento(){
        return $this->numDocumento;
    }

    public function setNumDocumento($numDocumento){
        $this->numDocumento = $numDocumento;
    }

    public function getAsunto(){
        return $this->asunto;
    }

    public function setAsunto($asunto){
        $this->asunto = $asunto;
    }

    public function getFolios(){
        return $this->folios;
    }

    public function setFolios($folios){
        $this->folios = $folios;
    }

    public function getTipoDocumento(){
        return $this->tipoDocumento;
    }

    public function setTipoDocumento($tipoDocumento){
        $this->tipoDocumento = $tipoDocumento;
    }

    public function getFechaRegistro(){
        return $this->fechaRegistro;
    }

    public function setFechaRegistro($fechaRegistro){
        $this->fechaRegistro = $fechaRegistro;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getDocumentosPendientesRecepcion(){
        $sql = "select d.NroDocumento 'NUMERO DE DOCUMENTO', d.folios 'FOLIOS', d.asunto 'ASUNTO', tp.descripcion 'TIPO DOCUMENTO',".
                "aro.descripcion 'AREA ORIGEN', concat(a.nombres, ' ', a.apellidos) 'ADMINISTRADO ORIGEN', e.fechaEnvio 'FECHA DERIVACION',  e.observacion 'OBSERVACION', ee.descripcion 'ESTADO ENVIO' ".
                "from Movimiento as m ".
                "inner join Documento as d on m.NroDocumento = d.NroDocumento ".
                "inner join TipoDocumento as tp on d.codTipoDocumento = tp.codTipoDocumento ".
                "inner join Envio as e on m.codEnvio = e.codEnvio ".
                "inner join Administrado as a on e.codAdministrado = a.codAdministrado ".
                "inner join Estado as ee on ee.codEstado = e.codEstado ".
                "inner join Area aro on aro.codArea = a.codArea ".
                "where ee.descripcion = 'derivado'";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function guardarNuevoDocumento(){

        $sql = "INSERT INTO Documento(NumDocumento, asunto, folios, codTipoDocumento, fechaRegistro, codUsuario, codEstado) ".
                "values(:numDocumento, :asunto, :folios, :codTipoDocumento, :fechaRegistro, :usuario, :estado)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":numDocumento", $this->numDocumento, PDO::PARAM_STR);
            $stmt->bindParam(":asunto", $this->asunto, PDO::PARAM_STR);
            $stmt->bindParam(":folios", $this->folios, PDO::PARAM_INT);
            $stmt->bindParam(":codTipoDocumento", $this->tipoDocumento, PDO::PARAM_INT);
            $stmt->bindParam(":fechaRegistro", $this->fechaRegistro, PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $this->usuario, PDO::PARAM_INT);
            $stmt->bindParam(":estado", $this->estado, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Documento registrado',
                'action' => 'registrar',
                'module' => 'documento',
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el documento',
                'action' => 'registrar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function existeDocumento(){
        $response = false;

        $sql = "select * from Documento where NumDocumento = :numDocumento";

        $stmt = DataBase::connect()->prepare($sql);

        $stmt->bindParam(":numDocumento", $this->numDocumento, PDO::PARAM_STR);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0){
            return [
                'status' => 'warning',
                'message' => '¡El documento ya se encuentra registrado!',
                'action' => 'registrar',
                'module' => 'documento',
                'info' => ''
            ];
        }

        return $response;
    }
}
