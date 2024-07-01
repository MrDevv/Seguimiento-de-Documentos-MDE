<?php

class Documento{
    private $nroDocumento;
    private $asunto;
    private $folios;
    private $tipoDocumento;
    private $fechaRegistro;

    public function __construct()
    {
    }

    /*
    public function __construct($nroDocumento, $asunto, $folios, TipoDocumento $tipoDocumento, $fechaRegistro){
        $this->nroDocumento = $nroDocumento;
        $this->asunto = $asunto;
        $this->folios = $folios;
        $this->tipoDocumento = $tipoDocumento;
        $this->fechaRegistro = $fechaRegistro;
    }*/

    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }

    public function setNroDocumento($nroDocumento)
    {
        $this->nroDocumento = $nroDocumento;
    }

    public function getAsunto()
    {
        return $this->asunto;
    }

    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    }

    public function getFolios()
    {
        return $this->folios;
    }

    public function setFolios($folios)
    {
        $this->folios = $folios;
    }

    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
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

    public  function guardarNuevoDocumento(){
        $sql = "INSERT INTO TipoDocumento(descripcion) values(:descripcion)";
        $sql = "INSERT INTO Documento(NroDocumento, asunto, folios, codTipoDocumento, fechaRegistro) ".
                "values(:nroDocumento, :asunto, :folios, :codTipoDocumento, :fechaRegistro)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":nroDocumento", $this->nroDocumento, PDO::PARAM_STR);
            $stmt->bindParam(":asunto", $this->asunto, PDO::PARAM_STR);
            $stmt->bindParam(":folios", $this->folios, PDO::PARAM_INT);
            $stmt->bindParam(":codTipoDocumento", $this->tipoDocumento, PDO::PARAM_INT);
            $stmt->bindParam(":fechaRegistro", $this->fechaRegistro, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Documento registrado',
                'action' => 'registrar'
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el documento',
                'action' => 'registrar',
                'info' => $e->getMessage()
            ];
        }
    }
}
