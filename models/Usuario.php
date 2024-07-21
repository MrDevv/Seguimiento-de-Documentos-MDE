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
        $sql = "EXEC sp_autenticarUsuario :nombreUsuario, :password";

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

    public function registrarUsuario(string $nombres, string $apellidos, string $telefono, string $dni, string $nombreUsuario, int $codRol, string $password, int $codArea){
        $sql = "EXEC sp_registrarUsuario :nombres, :apellidos, :telefono, :dni, :nombreUsuario, :codRol, :password, :codArea";

        try {
            $db = DataBase::connect();
            $stmt =  $db->prepare($sql);

            $stmt->bindParam("nombres", $nombres, PDO::PARAM_STR);
            $stmt->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
            $stmt->bindParam("telefono", $telefono, PDO::PARAM_STR);
            $stmt->bindParam("dni", $dni, PDO::PARAM_STR);
            $stmt->bindParam("nombreUsuario", $nombreUsuario, PDO::PARAM_STR);
            $stmt->bindParam("codRol", $codRol, PDO::PARAM_INT);
            $stmt->bindParam("password", $password, PDO::PARAM_INT);
            $stmt->bindParam("codArea", $codArea, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Usuario registrado',
                'action' => 'registrar',
                'module' => 'usuario',
                'data' => [],
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
        $sql = "select ua.codUsuarioArea, u.codPersona, u.codUsuario, u.codRol, u.nombreUsuario 'usuario', e.descripcion 'estado', ".
                "p.nombres, p.apellidos, p.dni, p.telefono, a.descripcion 'area', ".
                "r.descripcion 'rol' ".
                "from UsuarioArea ua ".
                "inner join Usuario u on ua.codUsuario = u.codUsuario ".
                "inner join Persona p on u.codPersona = p.codPersona ".
                "inner join Area a on ua.codArea = a.codArea ".
                "inner join Estado e on ua.codEstado = e.codEstado ".
                "inner join Rol r on u.codRol = r.codRol";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function listarUsuariosActivos(){
        // agregar la consulta correcta
        $sql = "select ua.codUsuarioArea, u.codUsuario, u.nombreUsuario 'usuario', e.descripcion 'estado', ".
            "p.nombres, p.apellidos, p.dni, p.telefono, a.descripcion 'area', ".
            "r.descripcion 'rol' ".
            "from UsuarioArea ua ".
            "inner join Usuario u on ua.codUsuario = u.codUsuario ".
            "inner join Persona p on u.codPersona = p.codPersona ".
            "inner join Area a on ua.codArea = a.codArea ".
            "inner join Estado e on ua.codEstado = e.codEstado ".
            "inner join Rol r on u.codRol = r.codRol";
            "where ua.codEstado = 2";

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

    public function actualizarUsuario(int $codPersona, string $nombre, string $apellidos, string $telefono, string $dni, string $usuario, int $rol){
        $sql = "EXEC sp_actualizarUsuarioPersona :codPersona, :nombres, :apellidos, :telefono, :dni, :codRol, :usuario";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam("codPersona", $codPersona, PDO::PARAM_INT);
            $stmt->bindParam("nombres", $nombre, PDO::PARAM_STR);
            $stmt->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
            $stmt->bindParam("telefono", $telefono, PDO::PARAM_STR);
            $stmt->bindParam("dni", $dni, PDO::PARAM_STR);
            $stmt->bindParam("codRol", $rol, PDO::PARAM_INT);
            $stmt->bindParam("usuario", $usuario, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Usuario actualizado',
                'action' => 'actualizar',
                'module' => 'usuario',
                'data' => [],
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar al usuario',
                'action' => 'actualizar',
                'module' => 'usuario',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

}