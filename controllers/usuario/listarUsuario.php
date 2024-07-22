<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";

$estado = $_POST['estado'];

$usuarioModel = new Usuario();

if ($estado=='Activos'){
    $response = $usuarioModel->listarUsuariosActivos();
}else{
    $response = $usuarioModel->listarUsuariosInactivos();
}

print json_encode($response);