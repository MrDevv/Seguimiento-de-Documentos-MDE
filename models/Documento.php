<?php

class Documento{
    private $numDocumento;
    private $asunto;
    private $folios;
    private $tipoDocumento;
    private $fechaRegistro;
    private $horaRegistro;
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

    public function getHoraRegistro(){
        return $this->horaRegistro;
    }

    public function setHoraRegistro($horaRegistro): void{
        $this->horaRegistro = $horaRegistro;
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

        $sql = "EXEC sp_registrarDocumento :numDocumento, :asunto, :folios, :codTipoDocumento, :usuario, :fechaRegistro, :horaRegistro";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam("numDocumento", $this->numDocumento, PDO::PARAM_STR);
            $stmt->bindParam("asunto", $this->asunto, PDO::PARAM_STR);
            $stmt->bindParam("folios", $this->folios, PDO::PARAM_INT);
            $stmt->bindParam("codTipoDocumento", $this->tipoDocumento, PDO::PARAM_INT);
            $stmt->bindParam("fechaRegistro", $this->fechaRegistro, PDO::PARAM_STR);
            $stmt->bindParam("horaRegistro", $this->horaRegistro, PDO::PARAM_STR);
            $stmt->bindParam("usuario", $this->usuario, PDO::PARAM_INT);

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
                "inner join UsuarioArea ua on d.codUsuario = ua.codUsuarioArea ".
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
                    'message' => 'documento encontrado',
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

    public function obtenerTotalDocumentosRegistrados($numDocumento = '', $codArea = null){
        $sql = "EXEC sp_totalDocumentos :codUsuario, :numDocumento, :codArea";

        try {
            $db = DataBase::connect();
            $stmt =  $db->prepare($sql);
            $stmt->bindParam("numDocumento", $numDocumento, PDO::PARAM_STR);
            $stmt->bindParam('codUsuario', $this->usuario, PDO::PARAM_INT);
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
                'message' => 'Ocurrio un error al momento de obtener el total de registros',
                'action' => 'listar',
                'module' => 'documento',
                'data' => [],
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

    public function listarDocumentos(int $codArea = null, $pagina = 1, $registroPorPagina = 10){
        $sql =  "EXEC sp_listarDocumentos :codUsuario, :numDocumento, :codArea, :pagina, :registroPorPagina";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codUsuario', $this->usuario, PDO::PARAM_INT);
            $stmt->bindParam('numDocumento', $this->numDocumento, PDO::PARAM_STR);
            $stmt->bindParam('codArea', $codArea, PDO::PARAM_INT);
            $stmt->bindParam('pagina', $pagina, PDO::PARAM_INT);
            $stmt->bindParam('registroPorPagina', $registroPorPagina, PDO::PARAM_INT);

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

    public function finalizarSeguimiento(){
        $sql = "EXEC sp_finalizarSeguimientoDocumento :numDocumento";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('numDocumento', $this->numDocumento, PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Se finalizó el seguimiento del documento',
                    'action' => 'actualizar',
                    'module' => 'documento',
                    'data' => [],
                    'info' => ''
                ];
            } else {
                return [
                    'status' => 'failed',
                    'message' => '¡No se pudo finalizar el seguimiento del documento!',
                    'action' => 'actualizar',
                    'module' => 'documento',
                    'data' => [],
                    'info' => ''
                ];
            }


        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de intentar finalizar el seguimiento del documento',
                'action' => 'actualizar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function continuarSeguimiento(){
        $sql = "EXEC sp_continuarSeguimientoDocumento :numDocumento";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('numDocumento', $this->numDocumento, PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Se reaundó el seguimiento del documento',
                    'action' => 'actualizar',
                    'module' => 'documento',
                    'data' => [],
                    'info' => ''
                ];
            } else {
                return [
                    'status' => 'failed',
                    'message' => '¡No se pudo reanudar el seguimiento del documento!',
                    'action' => 'actualizar',
                    'module' => 'documento',
                    'data' => [],
                    'info' => ''
                ];
            }


        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de intentar reanudar el seguimiento del documento',
                'action' => 'actualizar',
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

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'message' => '¡Se cambió el estado del documento!',
                    'action' => 'listar',
                    'module' => 'documento',
                    'data' => [],
                    'info' => ''
                ];
            } else {
                return [
                    'status' => 'failed',
                    'message' => '¡No se pudo cambiar el estado del documento!',
                    'action' => 'listar',
                    'module' => 'documento',
                    'data' => [],
                    'info' => ''
                ];
            }


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

    public function verSeguimientoDocumento(){
        $sql = "EXEC sp_verSeguimientoDocumento :numDocumento";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('numDocumento', $this->numDocumento, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'message' => '¡Se encontró el seguimiento del documento!',
                'action' => 'ver',
                'module' => 'documento',
                'data' => $results,
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de ver el seguimiento del documento',
                'action' => 'ver',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function reportesPorArea(int $codArea = null, string $numDocumento = null){
        $sql = 'EXEC sp_reporteDocumentosPorArea :codArea, :numDocumento';

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codArea', $codArea, PDO::PARAM_INT);
            $stmt->bindParam('numDocumento', $numDocumento, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'message' => '¡Se obtuvo el reporte de documentos por area!',
                'action' => 'listar',
                'module' => 'documento',
                'data' => $results,
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de cargar el reporte de Areas',
                'action' => 'listar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }
    public function reportesPorUsuario(int $codArea = null, string $numDocumento = null, int $codUsuarioAreaDestino = null){
        $sql = 'EXEC sp_reporteDocumentosPorUsuario :codArea, :numDocumento, :codUsuarioAreaDestino';

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codArea', $codArea, PDO::PARAM_INT);
            $stmt->bindParam('numDocumento', $numDocumento, PDO::PARAM_STR);
            $stmt->bindParam('codUsuarioAreaDestino', $codUsuarioAreaDestino, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'message' => '¡Se obtuvo el reporte de documentos por usuario!',
                'action' => 'listar',
                'module' => 'documento',
                'data' => $results,
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de cargar el reporte de usuarios',
                'action' => 'listar',
                'module' => 'documento',
                'info' => $e->getMessage()
            ];
        }
    }
}
