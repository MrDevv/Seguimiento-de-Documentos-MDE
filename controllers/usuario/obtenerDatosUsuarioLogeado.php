<?php
require_once "../../config/DataBase.php";
require_once "../../models/Usuario.php";
session_start();

$usuarioModel = new Usuario();

$response = $usuarioModel->obtenerDatosUsuarioLogeado((int) $_SESSION['user']['codUsuarioArea']);

print json_encode($response);