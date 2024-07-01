<?php

class Usuario {
    private $codUsuario;
    private $usuario;
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

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
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
        $sql = "INSERT INTO Usuario(usuario, rol, password, codEstado) values(:usuario, :rol, :password, :codEstado)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":usuario", $this->usuario, PDO::PARAM_STR);
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
                'message' => 'Ocurrio un error al momento de registrar el Area',
                'action' => 'registrar',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarUsuario(){
        $sql = "UPDATE Usuario SET usuario = :usuario, rol = :rol, password = :password, codEstado = :codEstado WHERE CodUsuario = :codUsuario";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":usuario", $this->ususario, PDO::PARAM_STR);
            $stmt->bindParam(":rol", $this->rol, PDO::PARAM_INT);
            $stmt->bindParam(":password", $this->password, PDO::PARAM_INT);
            $stmt->bindParam(":codEstado", $this->estado, PDO::PARAM_INT);
            $stmt->bindParam(":codUsuario", $this->codUsuario, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Usuario actualizada',
                'action' => 'actualizar'
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el usuario',
                'action' => 'actualizar',
                'info' => $e->getMessage()
            ];
        }
    }

}