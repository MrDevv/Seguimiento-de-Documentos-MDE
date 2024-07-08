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
        $sql = "select d.NumDocumento, tp.descripcion 'tipo documento', d.asunto, d.folios, d.fechaRegistro, ".
                "CONCAT(p.nombres ,p.apellidos) 'usuario registrador', e.descripcion 'estado' ".
                "from Documento d ".
                "inner join TipoDocumento tp on d.codTipoDocumento = tp.codTipoDocumento ".
                "inner join UsuarioArea ua on d.codUsuario = ua.codUsuario ".
                "inner join Usuario u on ua.codEstado = u.codUsuario ".
                "inner join Persona p on u.codPersona = p.codPersona ".
                "inner join Estado e on d.codEstado = e.codEstado ".
                "where d.NumDocumento = :numDocumento";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam(":numDocumento", $this->numDocumento, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0){
                return [
                    'status' => 'success',
                    'message' => '¡Documento encontrado!',
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
                'message' => 'Ocurrio un error al momento de buscar un documento',
                'action' => 'buscar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizar(){
        $sql = "update Documento set asunto = :asunto, folios = :folios, codTipoDocumento = :codTipoDocumento ".
                "where NumDocumento = :numDocumento";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('asunto', $this->asunto, PDO::PARAM_STR);
            $stmt->bindParam('folios', $this->folios, PDO::PARAM_INT);
            $stmt->bindParam(":codTipoDocumento", $this->tipoDocumento, PDO::PARAM_INT);
            $stmt->bindParam('numDocumento', $this->numDocumento, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Documento actualizado',
                'action' => 'actualizar',
                'module' => 'documento'
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el documento',
                'action' => 'actualizar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function listarDocumentos(){
        $sql = "select d.NumDocumento, tp.descripcion 'tipo documento', d.asunto, d.folios, d.fechaRegistro, ".
                "CONCAT(p.nombres ,p.apellidos) 'usuario registrador', e.descripcion 'estado' ".
                "from Documento d ".
                "inner join TipoDocumento tp on d.codTipoDocumento = tp.codTipoDocumento ".
                "inner join UsuarioArea ua on d.codUsuario = ua.codUsuario ".
                "inner join Usuario u on ua.codEstado = u.codUsuario ".
                "inner join Persona p on u.codPersona = p.codPersona ".
                "inner join Estado e on d.codEstado = e.codEstado ".
                "order by d.fechaRegistro DESC";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results)>0){
                return [
                    'status' => 'success',
                    'message' => 'listado correcto',
                    'action' => 'listar',
                    'module' => 'documento',
                    'data' => $results,
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => 'no se encontraron registros',
                'action' => 'listar',
                'module' => 'documento',
                'data' => [],
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de listar los documentos',
                'action' => 'listar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function cambiarEstadoDocumento(){
        $sql = "update Documento set codEstado = :codEstado where NumDocumento = :numDocumento";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codEstado', $this->estado, PDO::PARAM_INT);
            $stmt->bindParam('numDocumento', $this->numDocumento, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => '¡Se cambió el estado del documento!',
                'action' => 'listar',
                'module' => 'documento',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de cambiar el estado del documento',
                'action' => 'listar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }
}
