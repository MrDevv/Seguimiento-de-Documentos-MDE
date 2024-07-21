<?php
require_once "../../config/DataBase.php";
require_once "../../models/TipoDocumento.php";

$tipoDocumento = trim($_POST['descripcion']);
$codTipoDocumento = trim($_POST['codTipoDocumento']);

$tipoDocumentoModel = new TipoDocumento();

$tipoDocumentoModel->setDescripcion($tipoDocumento);
$response = $tipoDocumentoModel->existeTipoDocumento();


if ($response['message'] == 'tipo documento encontrado') {
    print json_encode($response);
}
else {
    $tipoDocumentoModel->setCodTipoDocumento($codTipoDocumento);
    $response = $tipoDocumentoModel->actualizarTipoDocumento();
    print json_encode($response);
}