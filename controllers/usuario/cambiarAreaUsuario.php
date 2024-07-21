<?php
require_once "../../config/DataBase.php";
require_once "../../models/UsuarioArea.php";

$codUsuarioArea = trim($_POST['codUsuarioArea']);
$codUsuario  = trim($_POST['codUsuario']);
$codArea = trim($_POST['codAreaNueva']);

$usuarioAreaModel = new UsuarioArea();

$usuarioAreaModel->setCodUsuarioArea($codUsuarioArea);
$usuarioAreaModel->setUsuario($codUsuario);
$usuarioAreaModel->setArea($codArea);
$response = $usuarioAreaModel->cambiarUsuarioArea();

print json_encode($response);