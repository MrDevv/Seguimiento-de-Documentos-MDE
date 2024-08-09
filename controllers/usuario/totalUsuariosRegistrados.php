<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";

$usuarioModel = new Usuario();

$estado = $_GET['estado'];
$apellidosBusqueda = $_GET['apellidosBusqueda'];

if ($estado== 0){
    $estado = null;
}else if($estado== 1){
    $estado = 'a';
}else if ($estado == 2){
    $estado = 'p';
}

$response = $usuarioModel->obtenerTotalUsuariosRegistrados($estado, $apellidosBusqueda);

print json_encode($response);