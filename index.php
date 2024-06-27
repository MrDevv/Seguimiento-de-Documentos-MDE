<?php
session_start();
require_once 'autoload.php';
require_once 'config/DataBase.php';
require_once 'config/parameters.php';
require_once 'views/layouts/head.php';
function show_error(){
    $error = new ErrorController();
    $error->index();
    exit();
}

if (isset($_SESSION["autenticado"])){
    if(isset($_GET['controller'])){
        $nombre_controlador = $_GET['controller'].'Controller';
    }elseif(!isset($_GET["controller"]) && !isset($_GET["action"])){
        $nombre_controlador = controller_default;
    }
    else{
        show_error();
    }
}else{
    $nombre_controlador = controller_login;
}

// comprobar si existe el controlador
if(class_exists($nombre_controlador)){
    $controlador = new $nombre_controlador();
        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
            $action = $_GET['action'];
            if ($action == "logout" || $action == "login"){
                $controlador->$action();
            }else if(isset($_SESSION["autenticado"])){
                if (method_exists($controlador, "estilosNavBar")){
                    $controlador->estilosNavBar();
                }
                require_once 'views/layouts/navbar.php';
                require_once 'views/layouts/content.php';
                $controlador->$action();
            }else{
                show_error();
            }
        }elseif(!isset($_GET["controller"]) && !isset($_GET["action"]) && !isset($_SESSION["autenticado"])){
            $action_default = action_login;
            $controlador->$action_default();
        }elseif(!isset($_GET["controller"]) && !isset($_GET["action"]) && isset($_SESSION["autenticado"])){
            $controlador->estilosNavBar();
            require_once 'views/layouts/navbar.php';
            require_once 'views/layouts/content.php';
            $action_default = action_default;
            $controlador->$action_default();
        }elseif(isset($_GET["controller"]) || isset($_GET["action"]) && !isset($_SESSION["autenticado"])){
            $action_default = action_logout;
            $controlador->$action_default();
        }
        else{
            show_error();
        }
}else{
    show_error();
}

require_once 'views/layouts/footer.php'; ?>