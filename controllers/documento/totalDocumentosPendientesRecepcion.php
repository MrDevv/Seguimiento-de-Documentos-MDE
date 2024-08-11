<?php
session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Recepcion.php";

$pendienteRecepcionModel = new Recepcion();

$rol = isset($_GET['rolFiltro']) ? $_GET['rolFiltro'] : null;


if ($rol == "0" || $rol == null) {
    $response = $pendienteRecepcionModel->obtenerTotalDocumentosPendienteRecepcion((int) $_SESSION['user']['codUsuarioArea']);
}else if ($rol == "1") {
    $response = $pendienteRecepcionModel->obtenerTotalDocumentosPendienteRecepcion((int) $_SESSION['user']['codUsuarioArea'],(int) $_SESSION['user']['codArea']);
}

print json_encode($response);