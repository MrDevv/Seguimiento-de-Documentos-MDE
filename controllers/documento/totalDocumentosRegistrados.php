<?php
session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";

$documentoModel = new Documento();

$numDocumento = $_GET['numDocumentoFiltro'];

if(trim($_SESSION['user']['rol']) == 'administrador'){
    $response = $documentoModel->obtenerTotalDocumentosRegistrados($numDocumento, null);
}else if(trim($_SESSION['user']['rol']) == 'usuario'){
    $documentoModel->setUsuario((int) $_SESSION['user']['codUsuarioArea']);
    $response = $documentoModel->obtenerTotalDocumentosRegistrados($numDocumento, null);
}else if(trim($_SESSION['user']['rol']) == 'administrador área'){
    $response = $documentoModel->obtenerTotalDocumentosRegistrados($numDocumento, $_SESSION['user']['codArea']);
}

print json_encode($response);