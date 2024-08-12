<?php
session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Envio.php";

$envioModel = new Envio();

$rol = isset($_GET['rolFiltro']) ? $_GET['rolFiltro'] : null;


if ($rol == "0" || $rol == null) {
    $response = $envioModel->obtenerTotalDocumentosEnviados((int) $_SESSION['user']['codUsuarioArea']);
}else if ($rol == "1") {
    $response = $envioModel->obtenerTotalDocumentosEnviados((int) $_SESSION['user']['codUsuarioArea'],(int) $_SESSION['user']['codArea']);
}

print json_encode($response);