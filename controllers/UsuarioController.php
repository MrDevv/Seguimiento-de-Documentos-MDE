<?php

require_once "models/Area.php";
require_once "models/Rol.php";
require_once "models/Usuario.php";

class UsuarioController{

    private Usuario $usuarioModel;

    public function __construct(){
        $this->usuarioModel = new Usuario();
    }

    public function index(){
        require_once 'views/login/index.php';
    }

    public function cambiarAreaUsuario(){
        $areaObj= new Area();
        $areas=$areaObj->listarArea();
        require_once "views/usuario/cambiarAreaUsuario.php";
    }

    public function login(){
        if ($_POST){
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $this->usuarioModel->setNombreUsuario($username);
            $this->usuarioModel->setPassword($password);
            $response = $this->usuarioModel->autenticarUsuario();

            if (count($response['data']) == 0){
                $response['status'] = 'not found';
                $_SESSION['response'] = $response;
                require_once "views/modals/alerta.php";
                exit();
            }

            $_SESSION['user'] = $response['data'][0];
            $_SESSION['autenticado'] = true;
            header('Location:'.base_url);
        }
    }

    public function  logout(){
        $_SESSION['user'] = false;
        $_SESSION['autenticado'] = false;
        unset($_SESSION['autenticado']);
        unset($_SESSION['user']);

        header('Location:'.base_url);
    }

    public function crear(){  
        $areaObj= new Area();
        $areas=$areaObj->listarArea();
        $rolObj= new Rol();
        $roles=$rolObj->listarRoles();
        require_once "views/usuario/registro.php";
    }

    public function editar(){
        if (isset($_GET["cod"])){
            $codUsuario = $_GET['cod'];
    
            $response = $this->buscar($codUsuario);
            $rolObj= new Rol();
            $roles=$rolObj->listarRoles();

 //          var_dump($areas);
            require_once "views/usuario/editarUsuario.php";
        }else{
//            Redirecciona a la vista de listado
            $this->redirect();
        }
        
    }

    function buscar($codUsuario){
        $usuario = new Usuario();
        $usuario->setCodUsuario($codUsuario);

        $response = $usuario->buscarUsuario();

        if (isset($response['message'])){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }
        return $response;
    }

    public function actualizar(){
        $codUsuario = isset($_POST['codUsuario']) ? (int) $_POST['codUsuario'] : false;
        $nombreUsuario = isset($_POST['nombreUsuario']) ? trim($_POST['nombreUsuario']) : false;
        $rol = isset($_POST['rol']) ? trim($_POST['rol']) : false;
        $estado = isset($_POST['estado']) ? trim($_POST['estado']) : false;

        if (!$codUsuario || !$nombreUsuario || !$estado){
            $this->redirect();
            exit();
        }

            $areaObj = new Area();
            $areaObj->setCodArea($codArea);
            $areaObj->setDescripcion($area);
            $areaObj->setEstado($estado);

            $response = $areaObj->actualizarArea();

            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
    }

    function listar(){
        $usuarioObj = new Usuario();
        $listadoUsuario = $usuarioObj->listarUsuario();

        // varificar los campos que retorna la consulta
        //var_dump($listadoUsuario);

        require_once "views/usuario/listarUsuario.php";
    }

    public function registrarUsuario(){
        if (isset($_POST)){
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $dni = isset($_POST['dni']) ? $_POST['dni'] : false;
            $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : false;
            $area = isset($_POST['area']) ? $_POST['area'] : false;

        
            if ($usuario && $nombre && $apellido ){
                $usuarioObj = new Usuario();
                $usuarioObj->setNombreUsuario($usuario);

                var_dump($usuarioObj);
//                $response [status, message, info]
                //$response = $usuarioObj->guardarUsuario();
//                var_dump($response);
                //$_SESSION['response'] = $response;
                //require_once "views/modals/alerta.php";
            }else{
                echo "campos incompletos";
            }
        }
    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "usuario";
    }

    public function redirect(){
        echo '<script type="text/javascript">
        window.location.href = "listar";
        </script>';
//        header('Location:'.base_url."tipoDocumento/crear");
    }
}
