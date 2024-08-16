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
            echo "
            <script>
                let rol = '{$_SESSION['user']['rol']}';
                localStorage.setItem('rol', rol);
            </script>
        ";
            echo "
            <script>
                window.location.href = '".base_url."';
            </script>
        ";
            exit();
        }

    }

    public function  editarPerfil() {
        if (isset($_GET["cod"])){
            $personaObj = new Persona();
            $usuarioObj = new Usuario();

            $codUsuario = $_GET['cod'];
            $responseUsuario = $this->buscar($codUsuario);

            $personaObj->setCodPersona($responseUsuario[0]['codPersona']);
            $responsePersona = $personaObj->buscarPersona();

            require_once "views/usuario/editarPerfil.php";
        }else{
//            Redirecciona a la vista de listado
            $this->redirect();
        }
    }

    public function  logout(){
        $_SESSION['user'] = false;
        $_SESSION['autenticado'] = false;
        unset($_SESSION['autenticado']);
        unset($_SESSION['user']);

        echo "
        <script>
            localStorage.removeItem('rol');
            window.location.href = '".base_url."';
        </script>
    ";
        exit();
        //header('Location:'.base_url);
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
}

