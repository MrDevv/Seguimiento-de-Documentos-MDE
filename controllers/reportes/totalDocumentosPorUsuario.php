<?php
session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";

$documentoModel = new Documento();

$response = [];

$numDocumento = null ;
$codUsuario = null;
$codArea = null;

if ($_SESSION['user']['rol'] == 'administrador'){
    if (isset($_GET['usuario']) && isset($_GET['numDocumento']) && $_GET['usuario']!= 0){
        $codUsuario = $_GET['usuario'];
        $numDocumento = $_GET['numDocumento'];
    }else if(isset($_GET['usuario']) && isset($_GET['numDocumento']) && $_GET['usuario']== 0){
        $numDocumento = $_GET['numDocumento'];
    }
}else if ($_SESSION['user']['rol'] == 'administrador área'){
    $codArea = $_SESSION['user']['codArea'];
    if (isset($_GET['usuario']) && isset($_GET['numDocumento']) && $_GET['usuario']!= 0){
        $codUsuario = $_GET['usuario'];
        $numDocumento = $_GET['numDocumento'];
    }else if(isset($_GET['usuario']) && isset($_GET['numDocumento']) && $_GET['usuario']== 0){
        $numDocumento = $_GET['numDocumento'];
    }
} else if($_SESSION['user']['rol'] == 'usuario'){
    $codUsuario = $_SESSION['user']['codUsuarioArea'];
    if(isset($_GET['numDocumento'])){
        $numDocumento = $_GET['numDocumento'];
    }
}

if($codUsuario && $numDocumento) {
    $response = $documentoModel->totalDocumentosPorUsuarioReporte($codArea, $numDocumento,(int) $codUsuario);
} else if ($numDocumento){
    $response = $documentoModel->totalDocumentosPorUsuarioReporte($codArea, $numDocumento, null);
}else if ($codUsuario){
    $response = $documentoModel->totalDocumentosPorUsuarioReporte($codArea, null, $codUsuario);
}else{
    $response = $documentoModel->totalDocumentosPorUsuarioReporte($codArea, null, null);
}

print json_encode($response);