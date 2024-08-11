<?php
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";

$documentoModel = new Documento();

$numDocumento = $_GET['numDocumentoFiltro'];

$response = $documentoModel->obtenerTotalDocumentosRegistrados($numDocumento);

print json_encode($response);