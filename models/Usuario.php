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

    public function obtenerDatosUsuarioLogeado($codUsuarioArea){
        $sql = "EXEC sp_obtenerDatosUsuarioLogeado :codUsuarioArea";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codUsuarioArea', $codUsuarioArea, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0){
                return [
                    'status' => 'success',
                    'message' => 'datos del perfil encontrado',
                    'action' => 'buscar',
                    'module' => 'usuario',
                    'data' => $result,
                    'info' => '',
                ];
            }
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de intentar obtener los datos del perfil de usuario',
                'action' => 'buscar',
                'module' => '',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarDatosPerfil($codPersona, $codUsuario, $nombres, $apellidos, $telefono, $dni, $password = null){
        $sql = "EXEC sp_actualizarPerfilUsuario :codPersona, :codUsuario, :nombres, :apellidos, :telefono, :dni, :password";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codPersona', $codPersona, PDO::PARAM_INT);
            $stmt->bindParam('codUsuario', $codUsuario, PDO::PARAM_INT);
            $stmt->bindParam('nombres', $nombres, PDO::PARAM_STR);
            $stmt->bindParam('apellidos', $apellidos, PDO::PARAM_STR);
            $stmt->bindParam('telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam('dni', $dni, PDO::PARAM_STR);
            $stmt->bindParam('password', $password, PDO::PARAM_STR);
            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Los datos del perfil fueron actualizados',
                'action' => 'actualizar',
                'module' => 'usuario',
                'data' => [],
                'info' => '',
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de intentar actualizar los datos del perfil',
                'action' => 'actualizar',
                'module' => 'usuario',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerTotalUsuariosRegistrados($estado = null, $apellidos = ''){
        $sql = "EXEC sp_totalUsuarios :estado, :apellidos";

        try {
            $db = DataBase::connect();
            $stmt =  $db->prepare($sql);
            $stmt->bindParam("estado", $estado, PDO::PARAM_INT);
            $stmt->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'message' => 'se obtuvo el total de registros',
                'action' => 'listar',
                'module' => 'usuario',
                'data' => $results,
                'info' => ''
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de obtener el total de registros',
                'action' => 'listar',
                'module' => 'usuario',
                'data' => [],
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

    public function listarUsuarios(int $codArea = null, $estado = null, $apellidos, $pagina = 1, $registrosPorPagina = 10){
        $sql = "EXEC sp_listarUsuarios :codArea, :estado, :apellidos, :pagina, :registrosPorPagina";

        try{
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam("codArea", $codArea, PDO::PARAM_INT);
            $stmt->bindParam("estado", $estado, PDO::PARAM_STR);
            $stmt->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
            $stmt->bindParam("pagina", $pagina, PDO::PARAM_INT);
            $stmt->bindParam("registrosPorPagina", $registrosPorPagina, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de listar los usuarios',
                'action' => 'listar',
                'info' => $e->getMessage()
            ];
        }

    }

    public function cambiarPassword(){
        $sql = "UPDATE usuario SET password = :password WHERE codUsuario = :codUsuario";
        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam("password", $this->password, PDO::PARAM_STR);
            $stmt->bindParam("codUsuario", $this->codUsuario, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Se cambió la contraseña al usuario',
                'action' => 'actualizar',
                'module' => 'usuario',
                'data' => [],
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de intentar cambiar la contraseña al usuario',
                'action' => 'buscar',
                'info' => $e->getMessage()
            ];
        }
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