<?php
session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Recepcion.php";

$recepcionModel = new Recepcion();

$rol = isset($_GET['rolFiltro']) ? $_GET['rolFiltro'] : null;


if ($rol == "0" || $rol == null) {
    $response = $recepcionModel->obtenerTotalDocumentosRecepcionados((int) $_SESSION['user']['codUsuarioArea']);
}else if ($rol == "1") {
    $response = $recepcionModel->obtenerTotalDocumentosRecepcionados((int) $_SESSION['user']['codUsuarioArea'],(int) $_SESSION['user']['codArea']);
}

print json_encode($response);