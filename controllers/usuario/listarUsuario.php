<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";
session_start();

$estado = isset($_POST['estado']) ? $_POST['estado'] : null;
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : null;
$apellidosBusqueda = isset($_POST['apellidosBusqueda']) ? $_POST['apellidosBusqueda'] : null;
$registrosPorPagina = isset($_POST['registrosPorPagina']) ? $_POST['registrosPorPagina'] : null;
$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';

if ($estado== 0){
    $estado = "todos";
}else if($estado== 1){
    $estado = "activos";
}else if ($estado == 2){
    $estado = "inactivos";
}

$usuarioModel = new Usuario();

if ($estado){
    if ($estado =='todos'){
        $response = $usuarioModel->listarUsuarios(null, null, $apellidosBusqueda, $pagina, $registrosPorPagina);
    } else if ($estado =='activos'){
        $response = $usuarioModel->listarUsuarios(null, 'a', $apellidosBusqueda, $pagina, $registrosPorPagina);
    }else if ($estado == "inactivos"){
        $response = $usuarioModel->listarUsuarios(null, 'p', $apellidosBusqueda, $pagina, $registrosPorPagina);
    }
}else{
    if ($_SESSION['user']['rol'] == 'administrador área') {
        $response = $usuarioModel->listarUsuarios((int)$_SESSION['user']['codArea'], null, $apellidosBusqueda, $pagina, $registrosPorPagina);
    }
}

print json_encode($response);

