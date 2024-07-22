<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";

$apellidos = $_POST['apellidos'];

$usuarioModel = new Usuario();

$response = $usuarioModel->buscarUsuarioPorApellidos($apellidos);

print json_encode($response);