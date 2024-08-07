<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";
session_start();

$estado = isset($_POST['estado']) ? $_POST['estado'] : null;

$usuarioModel = new Usuario();

if ($estado){
    if ($estado=='Activos'){
        $response = $usuarioModel->listarUsuariosActivos();
    }else{
        $response = $usuarioModel->listarUsuariosInactivos();
    }
}else{
    if ($_SESSION['user']['rol'] == 'administrador área') {
        $response = $usuarioModel->listarUsuarios((int)$_SESSION['user']['codArea']);
    }else{
        $response = $usuarioModel->listarUsuarios();
    }
}

print json_encode($response);

