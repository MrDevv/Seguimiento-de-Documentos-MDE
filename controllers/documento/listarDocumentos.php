<?php
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";
session_start();

$documentoModel = new Documento();

$numDocumento = isset($_POST['numDocumentoFiltro']) ? $_POST['numDocumentoFiltro'] : null;
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : null;
$registrosPorPagina = isset($_POST['registrosPorPagina']) ? $_POST['registrosPorPagina'] : null;

$documentoModel->setNumDocumento($numDocumento);

if(trim($_SESSION['user']['rol']) == 'administrador'){
    $response = $documentoModel->listarDocumentos(null, $pagina, $registrosPorPagina);
}else if(trim($_SESSION['user']['rol']) == 'usuario'){
    $documentoModel->setUsuario((int) $_SESSION['user']['codUsuarioArea']);
    $response = $documentoModel->listarDocumentos(null, $pagina, $registrosPorPagina);
}else if(trim($_SESSION['user']['rol']) == 'administrador área'){
    $response = $documentoModel->listarDocumentos($_SESSION['user']['codArea'], $pagina, $registrosPorPagina);
}

print json_encode($response);