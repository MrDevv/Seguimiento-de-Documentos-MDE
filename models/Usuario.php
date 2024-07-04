<?php

class Usuario {
    private $codUsuario;
    private $nombreUsuario;
    private $rol;
    private $password;
    private $codEstado;

    public function __construct(){

    }

    public function getCodUsuario(){
        return $this->codUsuario;
    }

    public function setCodUsuario($codUsuario){
        $this->codUsuario = $codUsuario;
    }

    public function getNombreUsuario(){
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario){
        $this->nombreUsuario = $nombreUsuario;
    }

    public function getRol(){
        return $this->rol;
    }

    public function setRol($rol){
        $this->rol = $rol;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getCodEstado(){
        return $this->codEstado;
    }

    public function setCodEstado($codEstado){
        $this->codEstado = $codEstado;
    }

    public function registrarUsuario(){
        $sql = "INSERT INTO Usuario(codUsuario, nombreUsuario, rol, password, codEstado) values(:codUsuario, :nombreUsuario, :rol, :password, :codEstado)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":codUsuario", $this->ncodUsuario, PDO::PARAM_STR);
            $stmt->bindParam(":nombreUsuario", $this->nombreUsuario, PDO::PARAM_STR);
            $stmt->bindParam(":rol", $this->rol, PDO::PARAM_STR);
            $stmt->bindParam(":password", $this->password, PDO::PARAM_STR);
            $stmt->bindParam(":codEstado", $this->estado, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Usuario registrado',
                'action' => 'registrar'
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el Usuario',
                'action' => 'registrar',
                'info' => $e->getMessage()
            ];
        }
    }

    public function listarUsuario(){
        // agregar la consulta correcta
        $sql = "SELECT * FROM Usuario";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function buscarUsuario(){
        $sql = "SELECT * FROM Uusario WHERE CodUsuario = :codUsuario";
        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":codUsuario", $this->codUsuario, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (sizeof($results) == 0){
                return [
                    'status' => 'not found',
                    'message' => 'No existe un usuario',
                    'action' => 'buscar'
                ];
            }

            return $results;

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar al usuario',
                'action' => 'buscar',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarUsuario(){
        $sql = "UPDATE Usuario SET nombreUsuario = :nombreUsuario, rol = :rol, password = :password, codEstado = :codEstado WHERE CodUsuario = :codUsuario";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":nombreUsuario", $this->nombreUsusario, PDO::PARAM_STR);
            $stmt->bindParam(":rol", $this->rol, PDO::PARAM_INT);
            $stmt->bindParam(":password", $this->password, PDO::PARAM_INT);
            $stmt->bindParam(":codEstado", $this->estado, PDO::PARAM_INT);
            $stmt->bindParam(":codUsuario", $this->codUsuario, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Usuario actualizado',
                'action' => 'actualizar'
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar al usuario',
                'action' => 'actualizar',
                'info' => $e->getMessage()
            ];
        }
    }

    /*$stmt = DataBase::connect()->query($sql);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results; */

}