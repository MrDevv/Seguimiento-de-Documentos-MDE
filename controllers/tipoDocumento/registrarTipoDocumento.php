<?php
require_once "../../config/DataBase.php";
require_once "../../models/TipoDocumento.php";

$tipoDocumento = trim($_POST['descripcion']);

$tipoDocumentoModel = new TipoDocumento();

$tipoDocumentoModel->setDescripcion($tipoDocumento);
$response = $tipoDocumentoModel->existeTipoDocumento();


if ($response['message'] == 'tipo documento encontrado') {
    print json_encode($response);
}
else {
    $response = $tipoDocumentoModel->guardarTipoDocumento();
    print json_encode($response);
}