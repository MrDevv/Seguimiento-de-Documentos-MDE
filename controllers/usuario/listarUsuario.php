<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";

$estado = isset($_POST['estado']) ? $_POST['estado'] : null;

$usuarioModel = new Usuario();

if ($estado){
    if ($estado=='Activos'){
        $response = $usuarioModel->listarUsuariosActivos();
    }else{
        $response = $usuarioModel->listarUsuariosInactivos();
    }
}else{
    $response = $usuarioModel->listarUsuarios();
}


print json_encode($response);