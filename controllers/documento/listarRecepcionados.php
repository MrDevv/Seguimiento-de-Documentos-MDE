<?php
require_once "../../config/DataBase.php";
require_once "../../models/Recepcion.php";
session_start();

$pendienteRecepcionModel = new Recepcion();

$rol = isset($_POST['rol']) ? $_POST['rol'] : null;

if ($rol == "0" || $rol == null) {
    $response = $pendienteRecepcionModel->listarDocumentosRecepcionados((int) $_SESSION['user']['codUsuarioArea']);
}else if ($rol == "1") {
    $response = $pendienteRecepcionModel->listarDocumentosRecepcionados((int) $_SESSION['user']['codUsuarioArea'], (int) $_SESSION['user']['codArea']);
}

print json_encode($response);