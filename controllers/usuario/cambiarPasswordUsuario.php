<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";

$codUsuario  = trim($_POST['codUsuario']);
$password = trim($_POST['password']);

$usuarioModel = new Usuario();

$usuarioModel->setCodUsuario($codUsuario);
$usuarioModel->setPassword($password);
$response = $usuarioModel->cambiarPassword();

print json_encode($response);