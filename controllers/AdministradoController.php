<?php
require_once "models/Administrado.php";

class AdministradoController{

    public function crear(){  
        require_once "views/administrado/registro.php";
    }

    public function editar(){
        if (isset($_GET["cod"])){
            $codArea = $_GET['cod'];

            var_dump($codArea);
            require_once "views/administrado/editarAdministrado.php";
        }else{
//            Redirecciona a la vista de listado
            $this->redirect();
        }
        
    }

    function listar(){

        $administradoObj = new Administrado();
        $listadoAdministrado = $administradoObj->listarAdministrado();

//        var_dump($listadoArea);

        require_once "views/administrado/listarAdministrado.php";


    }

    public function registroNuevoAdministrado(){
        $_SESSION["registro"] = "habilitado";

        if (isset($_POST)){
            $administrado = isset($_POST['administrado']) ? $_POST['ADMINISTRADO'] : false;

            if ($administrado){
                $administradoObj = new Administrado();
                $administradoObj->setNombre($administrado);
//                $response [status, message, info]
                $response = $administradoObj->guardarAdministrado();
//                var_dump($response);
                $_SESSION['response'] = $response;
                require_once "views/modals/alerta.php";
            }
        }
    }

    

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "administrado";
    }

    public function redirect()
    {
        echo '<script type="text/javascript">
        window.location.href = "listar";
        </script>';
//        header('Location:'.base_url."area/crear");
    }
}