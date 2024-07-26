<?php
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";

$documentoModel = new Documento();

$numDocumento = $_POST['numDocumento'];

$documentoModel->setNumDocumento($numDocumento);
$response = $documentoModel->verSeguimientoDocumento();

print json_encode($response);