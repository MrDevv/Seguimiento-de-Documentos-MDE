<?php

class Recepcion{
    private $codRecepcion;
    private $fechaRecepcion;
    private $codAdministrado;
    private $codEstado;

    public function getCodRecepcion(){
        return $this->codRecepcion;
    }

    public function setCodRecepcion($codRecepcion){
        $this->codRecepcion = $codRecepcion;
    }

    public function getFechaRecepcion()
    {
        return $this->fechaRecepcion;
    }

    public function setFechaRecepcion($fechaRecepcion){
        $this->fechaRecepcion = $fechaRecepcion;
    }

    public function getCodAdministrado(){
        return $this->codAdministrado;
    }

    public function setCodAdministrado($codAdministrado){
        $this->codAdministrado = $codAdministrado;
    }

    public function getCodEstado(){
        return $this->codEstado;
    }

    public function setCodEstado($codEstado){
        $this->codEstado = $codEstado;
    }

    public function registrarRecepcion(){
        $nroDocumento = isset($_POST['nroDocumento']) ? trim($_POST['nroDocumento']) : false;
        $asunto = isset($_POST['asunto']) ? trim($_POST['asunto']) : false;
        $folios = isset($_POST['folios']) ? trim($_POST['folios']) : false;
        $tipoDocumento = isset($_POST['tipoDocumento']) ? trim($_POST['tipoDocumento']) : false;
        $fechaRegistro = $this->obtenerFechaActual();

        if ($nroDocumento && $asunto && $folios && $tipoDocumento && $fechaRegistro){
            $documentoObj = new Documento();
            $documentoObj->setNroDocumento($nroDocumento);
            $documentoObj->setAsunto($asunto);
            $documentoObj->setFolios($folios);
            $documentoObj->setTipoDocumento($tipoDocumento);
            $documentoObj->setFechaRegistro($fechaRegistro);

//                var_dump($documentoObj);
//                $response [status, message, info]
            $response = $documentoObj->guardarNuevoDocumento();
            var_dump($response);
            //$_SESSION['response'] = $response;
            //require_once "views/modals/alerta.php";
        }

    }

}