<?php
require_once "../../models/Recepcion.php";
require_once "../../config/DataBase.php";

$codRecepcion = trim($_POST['codRecepcion']);

$recepcionModel = new Recepcion();
$recepcionModel->setCodRecepcion($codRecepcion);
$response = $recepcionModel->cancelarRecepcion();

print json_encode($response);