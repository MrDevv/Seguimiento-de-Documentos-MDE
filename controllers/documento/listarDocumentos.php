<?php
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";
session_start();

$documentoModel = new Documento();

$numDocumento = isset($_POST['numDocumento']) ? $_POST['numDocumento'] : null;

if ($numDocumento){
    $documentoModel->setNumDocumento($numDocumento);
}

if(trim($_SESSION['user']['rol']) == 'administrador'){
    $response = $documentoModel->listarDocumentos();
}else if(trim($_SESSION['user']['rol']) == 'usuario'){
    $documentoModel->setUsuario((int) $_SESSION['user']['codUsuarioArea']);
    $response = $documentoModel->listarDocumentos();
}

print json_encode($response);