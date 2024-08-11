<?php
require_once "../../config/DataBase.php";
require_once "../../models/Recepcion.php";
session_start();

$pendienteRecepcionModel = new Recepcion();

$rol = isset($_POST['rolFiltro']) ? $_POST['rolFiltro'] : null;
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : null;
$registrosPorPagina = isset($_POST['registrosPorPagina']) ? $_POST['registrosPorPagina'] : null;

if ($rol == "0" || $rol == null) {
    $response = $pendienteRecepcionModel->listarDocumentosRecepcionados((int) $_SESSION['user']['codUsuarioArea'], null, $pagina, $registrosPorPagina);
}else if ($rol == "1") {
    $response = $pendienteRecepcionModel->listarDocumentosRecepcionados((int) $_SESSION['user']['codUsuarioArea'], (int) $_SESSION['user']['codArea'], $pagina, $registrosPorPagina);
}

print json_encode($response);