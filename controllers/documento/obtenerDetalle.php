<?php
require_once "../../config/DataBase.php";
require_once "../../models/Envio.php";

$envioModel = new Envio();

$codEnvio = $_POST['codEnvio'];

$envioModel->setCodEnvio((int) $codEnvio);
$response = $envioModel->obtenerDetalleEnvio();

print json_encode($response);