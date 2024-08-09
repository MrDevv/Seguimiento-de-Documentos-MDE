<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";

$codPersona = trim($_POST['codPersona']);
$codUsuario = trim($_POST['codUsuario']);
$nombres = trim($_POST['nombres']);
$apellidos = trim($_POST['apellidos']);
$telefono = trim($_POST['telefono']);
$dni = trim($_POST['dni']);
$password = trim($_POST['password']);


$usuarioModel = new Usuario();


if ($password == ''){
    $password = null;
}

$response = $usuarioModel->actualizarDatosPerfil($codPersona, $codUsuario, $nombres, $apellidos, $telefono, $dni, $password);

print json_encode($response);