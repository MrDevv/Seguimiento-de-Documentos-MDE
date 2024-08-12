<?php
require_once "../../config/DataBase.php";
require_once "../../models/Envio.php";
require_once "../../models/Estado.php";
require_once "../../models/Documento.php";
date_default_timezone_set('America/Lima');
session_start();

$codRecepcion = $_POST['codRecepcion'] != '' ? $_POST['codRecepcion'] : null;
$numDocumento = isset($_POST['numDocumento']) ? $_POST['numDocumento'] : false;
$folios = isset($_POST['folios']) ? $_POST['folios'] : false;
$indicacion = isset($_POST['indicacion']) ? $_POST['indicacion'] : false;
$observacion = isset($_POST['observacion']) ? $_POST['observacion'] : false;
$usuarioAreaDestino = isset($_POST['usuarioAreaDestino']) ? $_POST['usuarioAreaDestino'] : false;
$usuarioAreaEnvio = (int) $_SESSION['user']['codUsuarioArea'];
$fechaEnvio = date('Y-m-d');
$horaEnvio = date('H:i');


$envioModel = new Envio();

$response = $envioModel->registrarEnvio($codRecepcion, $numDocumento, $folios, $indicacion, $observacion, $usuarioAreaDestino, $usuarioAreaEnvio, $fechaEnvio, $horaEnvio);

print json_encode($response);