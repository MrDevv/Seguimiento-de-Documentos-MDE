<?php
session_start();
require_once "../../models/Documento.php";
require_once "../../config/DataBase.php";

$numDocumento = trim($_POST['numDocumento']);
$tipoDocumento = trim($_POST['tipoDocumento']);
$folios = trim($_POST['folios']);
$asunto = trim($_POST['asunto']);
$fechaActual = date('Y-m-d');
$horaActual = date('H:i');
$usuarioRegistrador = $_SESSION['user']['codUsuarioArea'];

$documentoModel = new Documento();
$documentoModel->setNumDocumento($numDocumento);

$response = $documentoModel->existeDocumento();

if ($response['message'] == 'documento encontrado') {
    print json_encode($response);
} else {
    $documentoModel->setTipoDocumento($tipoDocumento);
    $documentoModel->setFolios($folios);
    $documentoModel->setAsunto($asunto);
    $documentoModel->setFechaRegistro($fechaActual);
    $documentoModel->setHoraRegistro($horaActual);
    $documentoModel->setUsuario($usuarioRegistrador);
    $response = $documentoModel->guardarNuevoDocumento();
    print json_encode($response);
}
