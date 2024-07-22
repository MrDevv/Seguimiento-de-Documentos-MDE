<?php
require_once "../../config/DataBase.php";
require_once "../../models/UsuarioArea.php";

$codUsuarioArea = $_POST['codUsuarioArea'];

$areaUsuarioObj = new UsuarioArea();
$areaUsuarioObj->setCodUsuarioArea($codUsuarioArea);

$response = $areaUsuarioObj->deshabilitarUsuario();

print json_encode($response);