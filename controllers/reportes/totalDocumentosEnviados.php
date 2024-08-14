<?php
require_once "../../config/DataBase.php";
require_once "../../models/Envio.php";
session_start();

$enviadosModel = new Envio();

$numDocumento = $_GET['numDocumento'];
$fechaInicio = $_GET['fechaInicio']!='' ? $_GET['fechaInicio'] : null;
$fechaFin = $_GET['fechaFin']!='' ? $_GET['fechaFin'] : null;

$response = $enviadosModel->obtenerTotalDocumentosEnviadosReporte(
    (int) $_SESSION['user']['codUsuarioArea'],
    $fechaInicio,
    $fechaFin,
    $numDocumento
);

print json_encode($response);