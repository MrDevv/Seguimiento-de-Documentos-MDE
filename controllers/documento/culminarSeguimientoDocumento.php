<?php
require_once "../../models/Documento.php";
require_once "../../config/DataBase.php";

$numDocumento = trim($_POST['numDocumento']);

$documentoModel = new Documento();
$documentoModel->setNumDocumento($numDocumento);
$response = $documentoModel->existeDocumento();

if ($response['message'] == '¡No se encontraron resultados!') {
    print json_encode($response);
} else {
    $response = $documentoModel->documentoEnseguimiento($numDocumento);
    if ($response['message'] == 'En seguimiento') {
        $response = $documentoModel->finalizarSeguimiento();
        print json_encode($response);
    }else{
        print json_encode($response);
    }
}