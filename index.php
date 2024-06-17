<?php
require_once 'autoload.php';

require_once 'config/parameters.php';
require_once 'views/layouts/head.php';
require_once 'views/layouts/navbar.php';
require_once 'views/layouts/content.php';

if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'Controller';
}elseif(!isset($_GET["controller"]) && !isset($_GET["action"])){
    $nombre_controlador = controller_default;
}
else{
    show_error();
    exit();
}

// comprobar si existe el controlador
if(class_exists($nombre_controlador)){
    $controlador = new $nombre_controlador();

    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador->$action();
    }elseif(!isset($_GET["controller"]) && !isset($_GET["action"])){
        $action_default = action_default;
        $controlador->$action_default();
    }
    else{
        show_error();
    }
}else{
    show_error();
}


//require_once 'views/inicio.php';



require_once 'views/layouts/footer.php'; ?>