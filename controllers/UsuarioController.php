<?php

require_once "models/Area.php";
require_once "models/Rol.php";
require_once "models/Usuario.php";
require_once "models/Persona.php";
require_once "models/Estado.php";
require_once "models/UsuarioArea.php";

class UsuarioController{

    private Usuario $usuarioModel;

    public function __construct(){
        $this->usuarioModel = new Usuario();
    }

    public function index(){
        require_once 'views/login/index.php';
    }

    public function cambiarAreaUsuario(){
        if (isset($_GET["cod"])){
            $codUsuario = $_GET['cod'];

            $areaObj= new Area();
            $areas=$areaObj->listarArea();
            require_once "views/usuario/cambiarAreaUsuario.php";

        }else{
//            Redirecciona a la vista de listado
            $this->redirect();
        }
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

 //     
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

    public function actualizarAreaUsuario(){
        $codUsuario = isset($_POST['codUsuario']) ? (int) $_POST['codUsuario'] : false;
        $area = isset($_POST['area']) ? (int) $_POST['area'] : false;

        if (!$codUsuario || !$area){
            $this->redirect();
            exit();
        }

        $areaUsuarioObj = new UsuarioArea();
        $areaUsuarioObj->setCodUsuarioArea($codUsuario);
        //$areaUsuarioObj->setArea($codArea);
        //$areaUsuarioObj->setEstado((int)Estado::getIdEstadoInactivo());
        
        //var_dump($areaUsuarioObj);
        //exit();
        $response = $areaUsuarioObj->actualizarEstado((int)Estado::getIdEstadoInactivo());
        //$response = $areaUsuarioObj->actualizarArea((int)Estado::getIdEstadoInactivo());

        //$areaUsuarioObj->setUsuario($codUsuario);
        //$areaUsuarioObj->setArea($area);

        $_SESSION['response'] = $response;
        require_once "views/modals/alerta.php";

    }

    public function habilitarAreaUsuario(){
        $codUsuario = isset($_GET['cod']) ? (int) $_GET['cod'] : false;
        if (!$codUsuario){
            $this->redirect();
            exit();
        }
        $areaUsuarioObj = new UsuarioArea();
        $areaUsuarioObj->setCodUsuarioArea($codUsuario);
        
        $response = $areaUsuarioObj->actualizarEstado((int)Estado::getIdEstadoActivo());
        
        $_SESSION['response'] = $response;
        require_once "views/modals/alerta.php";

    }

    public function deshabilitarAreaUsuario(){
        $codUsuario = isset($_GET['cod']) ? (int) $_GET['cod'] : false;
        if (!$codUsuario){
            $this->redirect();
            exit();
        }
        $areaUsuarioObj = new UsuarioArea();
        $areaUsuarioObj->setCodUsuarioArea($codUsuario);
        
        $response = $areaUsuarioObj->actualizarEstado((int)Estado::getIdEstadoInactivo());
        
        $_SESSION['response'] = $response;
        require_once "views/modals/alerta.php";

    }

    function listar(){
        $usuarioObj = new Usuario();
        $listadoUsuario = $usuarioObj->listarUsuario();

        require_once "views/usuario/listarUsuario.php";
    }

    public function registrarUsuario(){
        if (isset($_POST)){
            $usuarioObj = new Usuario();
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $usuarioObj->setNombreUsuario($usuario);

            $response = $usuarioObj->existeUsuario();
            $contrasena = isset($_POST['password']) ? $_POST['password'] : false;
            $confirmarContrasena = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : false;
            if ($contrasena != $confirmarContrasena) {
                $response['status'] = 'warning';
                $response['message'] = 'Las contraseñas no coinciden';
                $_SESSION['response'] = $response;
                require_once "views/modals/alerta.php";
                exit();
            }

            if (count($response['data']) > 0){
                $response['status'] = 'warning';
                $response['message'] = '¡El usuario que intenta ingresar ya existe!';
                $_SESSION['response'] = $response;
                require_once "views/modals/alerta.php";
                exit();
            }

            $personaObj = new Persona();
            $nombres = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $dni = isset($_POST['dni']) ? $_POST['dni'] : false;


            if ($nombres && $apellidos && $telefono && $dni){
                $personaObj->setNombres($nombres);
                $personaObj->setApellidos($apellidos);
                $personaObj->setTelefono($telefono);
                $personaObj->setDni($dni);
                $personaObj->setEstado(Estado::getIdEstadoInactivo());

                $response = $personaObj->registrarNuevaPersona();
                $idPersona = $response['info']['id'];

            }else{
                echo "campos incompletos";
            }
        
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : false;
            $contrasena = isset($_POST['password']) ? $_POST['password'] : false;


            if ($usuario && $rol && $contrasena){
                $usuarioObj->setNombreUsuario($usuario);
                $usuarioObj->setRol($rol);
                $usuarioObj->setPassword($contrasena);
                $usuarioObj->setCodPersona($idPersona);
                $usuarioObj->setCodEstado(Estado::getIdEstadoActivo());

                
                $response = $usuarioObj->registrarUsuario();
                $idUsuario = $response['data']['id'];
 
                $_SESSION['response'] = $response;
                require_once "views/modals/alerta.php";
            }else{
                echo "campos incompletos";
            }


            // REGISTRAR DATOS USUARIOAREA
            $area = isset($_POST['area']) ? $_POST['area'] : false;

            $objUsuarioArea = new UsuarioArea();
            $objUsuarioArea->setUsuario($idUsuario);
            $objUsuarioArea->setArea($area);
            $objUsuarioArea->setEstado(Estado::getIdEstadoActivo());

            $response = $objUsuarioArea->registrarUsuarioArea();
            


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
