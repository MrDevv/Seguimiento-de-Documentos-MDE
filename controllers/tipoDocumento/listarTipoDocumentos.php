<?php
require_once "../../config/DataBase.php";
require_once "../../models/TipoDocumento.php";

$tipoDocumentoModel = new TipoDocumento();
$response = $tipoDocumentoModel->listarTipoDocumentos();

print json_encode($response);