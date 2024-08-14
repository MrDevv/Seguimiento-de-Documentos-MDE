<?php
require_once "../../config/DataBase.php";
require_once "../../models/Envio.php";
session_start();

$enviadosModel = new Envio();

$numDocumento = $_POST['numDocumento'];
$fechaInicio = $_POST['fechaInicio']!='' ? $_POST['fechaInicio'] : null;
$fechaFin = $_POST['fechaFin']!='' ? $_POST['fechaFin'] : null;
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : null;
$registrosPorPagina = isset($_POST['registrosPorPagina']) ? $_POST['registrosPorPagina'] : null;

$response = $enviadosModel->obtenerDocumentosEnviadosReporte(
    (int) $_SESSION['user']['codUsuarioArea'],
    $pagina,
    $registrosPorPagina,
    $fechaInicio,
    $fechaFin,
    $numDocumento
);

print json_encode($response);