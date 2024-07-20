<?php
require_once "models/Area.php";

class AreaController{

    public function crear(){
        require_once "views/area/registroArea.php";
    }

    function editar(){
        if (isset($_GET["cod"])){
            $codArea = $_GET['cod'];
            $response = $this->buscar($codArea);

 //           var_dump($codArea);
            require_once "views/area/editarArea.php";
        }else{
//            Redirecciona a la vista de listado
            $this->redirect();
        }
        
    }

    function buscar($codArea){
        $area = new Area();
        $area->setCodArea($codArea);

        $response = $area->buscarArea();

        if (isset($response['message'])){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }
        return $response;
    }

    public function actualizar(){
        $codArea = isset($_POST['codArea']) ? (int) $_POST['codArea'] : false;
        $area = isset($_POST['area']) ? trim($_POST['area']) : false;

        if (!$codArea || !$area){
            $this->redirect();
            exit();
        }

            $areaObj = new Area();
            $areaObj->setCodArea($codArea);
            $areaObj->setDescripcion($area);

            $response = $areaObj->actualizarArea();

            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
    }


    public function registrar(){
        if (isset($_POST)){
            $area = isset($_POST['area']) ? trim($_POST['area']) : false;

            if ($area ){
                $areaObj = new Area();
                $areaObj->setDescripcion($area);
//                $response [status, message, info]
                $response = $areaObj->registrarArea();
                //var_dump($response);
                $_SESSION['response'] = $response;
                require_once "views/modals/alerta.php";
            }
        }

    }

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "area";
    }

    public function redirect()
    {
        echo '<script type="text/javascript">
        window.location.href = "listar";
        </script>';
//        header('Location:'.base_url."area/crear");
    }
} 