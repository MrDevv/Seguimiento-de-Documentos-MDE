<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";

$codPersona = trim($_POST['codPersona']);
$nombre = trim($_POST['nombre']);
$apellidos = trim($_POST['apellidos']);
$telefono = trim($_POST['telefono']);
$dni = trim($_POST['dni']);
$usuario = trim($_POST['usuario']);
$rol = trim($_POST['rol']);

$usuarioModel = new Usuario();

$response = $usuarioModel->actualizarUsuario($codPersona, $nombre, $apellidos, $telefono, $dni, $usuario, $rol);

print json_encode($response);