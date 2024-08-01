<?php
require_once "../../models/Envio.php";
require_once "../../config/DataBase.php";

$codEnvio = trim($_POST['codEnvio']);

$envioModel = new Envio();
$envioModel->setCodEnvio($codEnvio);
$response = $envioModel->cancelarEnvio();

print json_encode($response);