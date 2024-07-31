<?php
require_once "../../config/DataBase.php";
require_once "../../models/Envio.php";
session_start();

$envioModel = new Envio();

$envioModel->setCodEstado(Estado::getIdEstadoInactivo());
$envioModel->setCodUsuarioAreaEnvio((int) $_SESSION['user']['codUsuarioArea']);
$response = $envioModel->obtenerDocumentosEnviados();

print json_encode($response);