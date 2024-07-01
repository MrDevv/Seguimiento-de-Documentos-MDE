<?php
require_once "models/Administrado.php";
require_once "models/Area.php";

class AdministradoController{

    public function crear(){  
        $areaObj= new Area();
        $areas=$areaObj->listarArea();
        require_once "views/administrado/registro.php";
    }

    public function editar(){
        if (isset($_GET["cod"])){
            $codAdministrado = $_GET['cod'];
            $response = $this->buscar($codAdministrado);
//            var_dump($response);
            $areaObj= new Area();
            $areas=$areaObj->listarArea();

 //          var_dump($areas);
            require_once "views/administrado/editarAdministrado.php";
        }else{
//            Redirecciona a la vista de listado
            $this->redirect();
        }
        
    }

    function buscar($codAdministrado){
        $administrado = new Administrado();
        $administrado->setCodAdministrado($codAdministrado);

        $response = $administrado->buscarAdministrado();

        if (isset($response['message'])){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }
        return $response;
    }

    public function actualizar(){
        $codAdministra = isset($_POST['codAdministrado']) ? (int) $_POST['codAdministrado'] : false;
        $administrado = isset($_POST['administrado']) ? trim($_POST['administrado']) : false;
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
        $codArea = isset($_POST['codArea']) ? trim($_POST['codArea']) : false;
        $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : false;
        $estado = isset($_POST['estado']) ? trim($_POST['estado']) : false;
        $estado = isset($_POST['estado']) ? trim($_POST['estado']) : false;

        if (!$codArea || !$area || !$estado){
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