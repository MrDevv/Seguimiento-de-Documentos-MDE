<?php
require_once "../../models/Documento.php";
require_once "../../config/DataBase.php";

$numDocumento = trim($_POST['numDocumento']);
$tipoDocumento = trim($_POST['tipoDocumento']);
$folios = trim($_POST['folios']);
$asunto = trim($_POST['asunto']);

$documentoModel = new Documento();
$documentoModel->setNumDocumento($numDocumento);
$documentoModel->setAsunto($asunto);
$documentoModel->setFolios((int) $folios);
$documentoModel->setTipoDocumento((int) $tipoDocumento);

$response = $documentoModel->actualizar();

print json_encode($response);
