<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";

$usuarioModel = new Usuario();
$response = $usuarioModel->listarUsuario();

print json_encode($response);