<?php
session_start();
require_once "../../config/DataBase.php";
require_once "../../models/UsuarioArea.php";

$codArea = $_POST['codArea'];

$usuarioAreaModel = new UsuarioArea();

$response = $usuarioAreaModel->obtenerUsuariosPorArea($codArea, $_SESSION['user']['codUsuario']);


print json_encode($response);