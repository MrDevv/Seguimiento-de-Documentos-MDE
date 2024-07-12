<?php

class Usuario {
    private $codUsuario;
    private $nombreUsuario;
    private $rol;
    private $password;
    private $codEstado;
    private $codPersona;

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

    public function getContrasena(){
        return $this->contrasena;
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

    public function getCodPersona(){
        return $this->codPersona;
    }

    public function setCodPersona($codPersona){
        $this->codPersona = $codPersona;
    }

    public function existeUsuario(){
        $sql= "SELECT * ".
              "FROM Usuario ".
              "WHERE nombreUsuario = :nombreUsuario ";

        try{
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam(":nombreUsuario", $this->nombreUsuario, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => '¡Usuario encontrado!',
                    'action' => 'buscar',
                    'module' => 'usuario',
                    'data' => $results,
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'usuario',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de buscar un usuario',
                'action' => 'buscar',
                'module' => 'usuario',
                'info' => $e->getMessage()
            ];
        }
    }

    public function autenticarUsuario(){
        $sql = "select ua.codUsuario, u.nombreUsuario, CONCAT(p.nombres, ' ',p.apellidos) 'nombres', ".
                "r.descripcion 'rol', a.descripcion 'area' ".
                "from Usuario u ".
                "inner join Rol r on u.codRol = r.codRol ".
                "inner join UsuarioArea ua on u.codUsuario = ua.codUsuario ".
                "inner join Area a on ua.codArea = a.codArea ".
                "inner join Persona p on u.codPersona = p.codPersona ".
                "where u.nombreUsuario = :nombreUsuario and u.password = :password";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('nombreUsuario', $this->nombreUsuario, PDO::PARAM_STR);
            $stmt->bindParam('password', $this->password, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) == 0){
                return [
                    'status' => 'success',
                    'message' => 'Credenciales incorrectas',
                    'action' => 'login',
                    'module' => '',
                    'data' => [],
                    'info' => '',
                ];
            }

            return [
                'status' => 'success',
                'message' => 'inicio de sesión correcto',
                'action' => 'login',
                'module' => '',
                'data' => $result,
                'info' => '',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de iniciar sesión',
                'action' => 'login',
                'module' => '',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function registrarUsuario(){
        $sql = "INSERT INTO Usuario(nombreUsuario, codRol, codPersona, password, codEstado) ". 
                "values(:nombreUsuario, :codRol, :codPersona, :password, :codEstado)";

        try {
            $db = DataBase::connect();
            $stmt =  $db->prepare($sql);

    
            $stmt->bindParam("nombreUsuario", $this->nombreUsuario, PDO::PARAM_STR);
            $stmt->bindParam("codRol", $this->rol, PDO::PARAM_INT);
            $stmt->bindParam("codPersona", $this->codPersona, PDO::PARAM_INT);
            $stmt->bindParam("password", $this->password, PDO::PARAM_STR);
            $stmt->bindParam("codEstado", $this->codEstado, PDO::PARAM_STR);

            $stmt->execute();

            $lastInsertId = $db->lastInsertId();

            return [
                'status' => 'success',
                'message' => 'Usuario registrado',
                'action' => 'registrar',
                'module' => 'usuario',
                'data' => ['id' => $lastInsertId],
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el Usuario',
                'action' => 'registrar',
                'module' => 'usuario',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function listarUsuario(){
        // agregar la consulta correcta
        $sql = "select ua.codUsuarioArea, u.codUsuario, u.nombreUsuario 'usuario', e.descripcion 'estado', ".
                "p.nombres, p.apellidos, p.dni, p.telefono, a.descripcion 'area', ".
                "r.descripcion 'rol' ".
                "from UsuarioArea ua ".
                "inner join usuario u on ua.codUsuario = u.codUsuario ".
                "inner join Persona p on u.codPersona = p.codPersona ".
                "inner join area a on ua.codArea = a.codArea ".
                "inner join Estado e on ua.codEstado = e.codEstado ".
                "inner join rol r on u.codRol = r.codRol";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function buscarUsuario(){
        $sql = "SELECT * FROM Usuario WHERE CodUsuario = :codUsuario";
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