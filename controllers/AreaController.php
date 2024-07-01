<?php
require_once "models/Area.php";

class AreaController{

    public function crear(){
        require_once "views/area/registroArea.php";
    }

    public function editar(){
        if (isset($_GET["cod"])){
            $codArea = $_GET['cod'];

            var_dump($codArea);
            require_once "views/area/editarArea.php";
        }else{
//            Redirecciona a la vista de listado
            $this->redirect();
        }
        
    }

    function listar(){

        $areaObj = new Area();
        $listadoArea = $areaObj->listarArea();

//        var_dump($listadoArea);

        require_once "views/area/listarArea.php";


    }

    public function registrarArea(){
        $_SESSION["registro"] = "habilitado";

        if (isset($_POST)){
            $area = isset($_POST['are']) ? $_POST['AREA'] : false;

            if ($area){
                $areaObj = new Area();
                $areaoObj->setDescripcion($area);
//                $response [status, message, info]
                $response = $areaObj->guardarArea();
//                var_dump($response);
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