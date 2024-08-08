<?php
require_once "../../config/DataBase.php";
require_once "../../models/Envio.php";
session_start();

$envioModel = new Envio();

$rol = isset($_POST['rol']) ? $_POST['rol'] : null;

if ($rol == "0" || $rol == null) {
    $response = $envioModel->obtenerDocumentosEnviados((int) $_SESSION['user']['codUsuarioArea']);
}else if ($rol == "1") {
    $response = $envioModel->obtenerDocumentosEnviados((int) $_SESSION['user']['codUsuarioArea'], (int) $_SESSION['user']['codArea']);
}

print json_encode($response);