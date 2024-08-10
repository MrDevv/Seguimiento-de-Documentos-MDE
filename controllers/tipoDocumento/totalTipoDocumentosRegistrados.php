<?php
require_once "../../config/DataBase.php";
require_once "../../models/TipoDocumento.php";

$tipoDocumentoModel = new TipoDocumento();

$response = $tipoDocumentoModel->obtenerTotalTipoDocumentosRegistrados();

print json_encode($response);