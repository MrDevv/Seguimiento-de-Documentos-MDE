<?php
require_once "../../config/DataBase.php";
require_once "../../models/Recepcion.php";
session_start();

$recepcionadosModel = new Recepcion();

$numDocumento = $_GET['numDocumento'];
$fechaInicio = $_GET['fechaInicio']!='' ? $_GET['fechaInicio'] : null;
$fechaFin = $_GET['fechaFin']!='' ? $_GET['fechaFin'] : null;

$response = $recepcionadosModel->obtenerTotalDocumentosPendienteRecepcionReporte(
    (int) $_SESSION['user']['codUsuarioArea'],
    $fechaInicio,
    $fechaFin,
    $numDocumento
);

print json_encode($response);