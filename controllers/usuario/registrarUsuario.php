<?php
require_once "../../models/Usuario.php";
require_once "../../models/Persona.php";
require_once "../../models/UsuarioArea.php";
require_once "../../config/DataBase.php";

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$dni = $_POST['dni'];
$usuario = $_POST['usuario'];
$rol = $_POST['rol'];
$area = $_POST['area'];
$password = $_POST['password'];

$usuarioModel = new Usuario();

$usuarioModel->setNombreUsuario($usuario);

$response = $usuarioModel->existeUsuario();
if ($response['message'] == '¡Usuario encontrado!'){
    print json_encode($response);
}else{
    $response = $usuarioModel->registrarUsuario($nombre, $apellidos, $telefono, $dni, $usuario, $rol, $password, $area);
    print json_encode($response);
}