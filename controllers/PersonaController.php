<?php
require_once "models/Persona.php";
require_once "models/Area.php";

class PersonaController{
    public function editar(){
        if (isset($_GET["cod"])){
            $codPersona = $_GET['cod'];
            $response = $this->buscar($codPersona);
//           
            $areaObj= new Area();
            $areas=$areaObj->listarArea();

 //        
            require_once "views/persona/editarPersona.php";
        }else{
//            Redirecciona a la vista de listado
            $this->redirect();
        }
        
    }

    function buscar($codPersona){
        $persona = new Persona();
        $persona->setCodPersona($codPersona);

        $response = $persona->buscarPersona();

        if (isset($response['message'])){
            $_SESSION['response'] = $response;
            require_once "views/modals/alerta.php";
            exit();
        }
        return $response;
    }

    public function actualizar(){
        $codPersona = isset($_POST['codPersona']) ? (int) $_POST['codPersona'] : false;
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
        $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : false;
        $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : false;
        $dni = isset($_POST['dni']) ? trim($_POST['dni']) : false;
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


    public function registroNuevaPersona(){
        $_SESSION["registro"] = "habilitado";

        if (isset($_POST)){
            $persona = isset($_POST['persona']) ? $_POST['PERSONA'] : false;

            if ($persona){
                $personaObj = new Persona();
                $personaObj->setNombre($persona);
//                $response [status, message, info]
                $response = $personaObj->guardarPersona();
//                var_dump($response);
                $_SESSION['response'] = $response;
                require_once "views/modals/alerta.php";
            }
        }
    }

    

    public function estilosNavBar(){
        $_SESSION["optionActive"] = "persona";
    }

    public function redirect()
    {
        echo '<script type="text/javascript">
        window.location.href = "listar";
        </script>';
//        header('Location:'.base_url."area/crear");
    }
}