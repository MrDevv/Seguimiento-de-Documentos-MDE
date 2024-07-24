<?php
require_once "../../models/Documento.php";
require_once "../../config/DataBase.php";

$numDocumento = trim($_POST['numDocumento']);

$documentoModel = new Documento();
$documentoModel->setNumDocumento($numDocumento);
$response = $documentoModel->continuarSeguimiento();

print json_encode($response);