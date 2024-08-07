<?php
require_once "../../config/DataBase.php";
require_once "../../models/Recepcion.php";
session_start();
date_default_timezone_set('America/Lima');

$codRecepcion = $_POST['codRecepcion'];
$fechaActual = date('Y-m-d');
$horaActual = date('H:i');

$recepcionModel = new Recepcion();

$recepcionModel->setCodRecepcion($codRecepcion);
$recepcionModel->setFechaRecepcion($fechaActual);
$recepcionModel->setHoraRecepcion($horaActual);

$response = $recepcionModel->confirmarRecepcion();

print json_encode($response);