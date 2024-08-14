<?php
require_once "../../config/DataBase.php";
require_once "../../models/Recepcion.php";
session_start();

$recepcionadosModel = new Recepcion();

$numDocumento = $_POST['numDocumento'];
$fechaInicio = $_POST['fechaInicio']!='' ? $_POST['fechaInicio'] : null;
$fechaFin = $_POST['fechaFin']!='' ? $_POST['fechaFin'] : null;
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : null;
$registrosPorPagina = isset($_POST['registrosPorPagina']) ? $_POST['registrosPorPagina'] : null;

$response = $recepcionadosModel->listarDocumentosRecepcionadosReporte(
    (int) $_SESSION['user']['codUsuarioArea'],
    $pagina,
    $registrosPorPagina,
    $fechaInicio,
    $fechaFin,
    $numDocumento
);

print json_encode($response);