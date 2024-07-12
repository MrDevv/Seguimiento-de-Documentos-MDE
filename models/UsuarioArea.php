<?php

class UsuarioArea{
    private $codUsuarioArea;
    private $usuario;
    private $area;
    private $estado;

    public function __construct(){}

    public function getCodUsuarioArea(){
        return $this->codUsuarioArea;
    }

    public function setCodUsuarioArea($codUsuarioArea): void{
        $this->codUsuarioArea = $codUsuarioArea;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario): void{
        $this->usuario = $usuario;
    }

    public function getArea(){
        return $this->area;
    }

    public function setArea($area): void{
        $this->area = $area;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado): void{
        $this->estado = $estado;
    }

    public function registrarUsuarioArea(){
        $sql = "INSERT INTO UsuarioArea(codUsuario, codArea, codEstado) ".
                "values(:codUsuario, :codArea, :codEstado)";
        
        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":codUsuario", $this->usuario, PDO::PARAM_INT);
            $stmt->bindParam(":codArea", $this->area, PDO::PARAM_INT);
            $stmt->bindParam(":codEstado", $this->estado, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Usuario registrado',
                'action' => 'registrar',
                'module' => 'usuario',
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar al usuario',
                'action' => 'registrar',
                'module' => 'usuario',
                'info' => $e->getMessage()
            ];
        }

    }

    public function actualizarEstado(int $codEstado){
        $sql = "UPDATE UsuarioArea SET codEstado = :codEstado ".
                "where codUsuarioArea = :codUsuarioArea";
        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codEstado', $codEstado, PDO::PARAM_INT);
            $stmt->bindParam('codUsuarioArea', $this->codUsuarioArea, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Estado actualizado',
                'action' => 'actualizar',
                'module' => 'usuario'
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el estado',
                'action' => 'actualizar',
                'module' => 'usuario',
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerUsuariosPorArea(int $codArea, int $codUsuarioArea){
        $sql = "select ua.codUsuarioArea, concat(p.nombres, ' ' ,p.apellidos) 'usuario' 
                        from UsuarioArea ua 
                        inner join Area a on ua.codArea = a.codArea
                        inner join Usuario u on ua.codUsuario = u.codUsuario
                        inner join Persona p on u.codPersona = p.codPersona 
                        where a.codArea = :codArea and ua.codUsuarioArea != :codUsuarioArea ";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam('codArea', $codArea, PDO::PARAM_INT);
            $stmt->bindParam('codUsuarioArea', $codUsuarioArea, PDO::PARAM_INT);

            $stmt->execute();

            $results =$stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results)>0){
                return [
                    'status' => 'success',
                    'message' => 'listado de usuarios correcto',
                    'action' => 'listar',
                    'module' => 'usuarioArea',
                    'data' => $results,
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => 'no se encontraron usuarios en esta area',
                'action' => 'listar',
                'module' => 'usuarioArea',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de listar los usuarios del area',
                'action' => 'listar',
                'module' => 'usuarioArea',
                'info' => $e->getMessage()
            ];
        }
    }




}